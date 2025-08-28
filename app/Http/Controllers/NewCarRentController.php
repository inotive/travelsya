<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CarModel;
use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use App\Models\City;
use App\Models\DetailTransactionCarRental;
use App\Models\Fee;
use App\Models\Point;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewCarRentController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function search_ajax(request $request){
        $find = '%' . $request->name . '%';

        // $carRent = CarRental::withCount('hasCars')->where('business_name', 'like', $find)->get();
        $cars = CarRentalHasCars::with('carRental', 'carRental.kota', 'brand', 'carModel')
            ->whereHas('carRental', function($q) use($find) {
                $q->where('business_name', 'like', $find);
            })
            ->get();

        $date = Carbon::now()->format('Y-m-d H:i');

        $result = '';
        foreach ($cars as $key => $car) {
            // Memastikan semua parameter tersedia
            $category = $car->category_rent ?? 'dengan driver';
            $lokasi = $car->carRental->kota->city_name ?? 'jakarta';
            $model = $car->car_model_id ?? 1;
            $provider = $car->id ?? 1;
            $duration = 1;
            
            // Membuat URL dengan parameter yang aman
            try {
                $url = route('car_rent.detail', [
                    'category' => $category,
                    'lokasi' => $lokasi,
                    'model' => $model,
                    'provider' => $provider,
                    'date' => $date,
                    'duration'=> $duration
                ]);
            } catch (\Exception $e) {
                // Jika ada error dalam membuat route, gunakan URL default
                $url = '#';
                \Log::error('Error creating car_rent.detail route: ' . $e->getMessage());
            }
            
            $result .= '<a href="' . $url . '" class="d-flex w-100 flex-stack">
                            <img src="' . asset($car->brand->image ?? 'images/default.jpg') .'" class="me-4 w-50px" style="border-radius: 4px" alt="">
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <span class="text-gray-800 text-hover-primary fs-6 fw-bold text-capitalize">' .
                                        ($car->brand->name ?? 'deleted brand') . ' - ' . ($car->carModel->name ?? 'deleted model') .
                                    '</span>
                                    <span class="text-muted fw-semibold d-block fs-7">' . 
                                        ($car->carRental->business_name ?? 'Unknown Rental') . ' - ' . ($car->carRental->kota->city_name ?? 'Unknown Location') .
                                    '</span>
                                </div>
                            </div>
                        </a>
                        <hr>';
        }

        // Jika tidak ada hasil, tampilkan pesan
        if (empty($result)) {
            $result = '<div class="mx-auto fw-bold text-center" style="color : var(--bs-gray-500)">Tidak ada data</div>';
        }

        return $result;
    }

    public function index()
    {
        // $car_models = CarModel::with('vendor')->limit(10)->get();

        $car_models = CarRentalHasCars::Active()
            ->with('carModel', 'brand', 'carRental', 'booked')
            ->withCount('booked')
            ->orderBy('booked_count', 'desc')
            ->limit(10)
            ->get();

        $data['rule'] = [
            [
                'icon' => 'fa-solid fa-car',
                'title' => 'Cara menyewa mobil',
                'content' => 'Cari tau mudahnya cara memesan Sewa mobil di Travelsya',
            ],
            [
                'icon' => 'fa-solid fa-file',
                'title' => 'Syarat Sewa mobil',
                'content' => 'Baca apa saja yang perlu kamu tahu dan siapkan sebelum menyewa',
            ],
            [
                'icon' => 'fa-solid fa-shield',
                'title' => 'Persyaratan Perjalanan',
                'content' => 'Cek protokol dan syarat selama pandemi',
            ],
        ];

        $near_location = CarRental::with('kota', 'hasCars')->whereHas('hasCars')->get()->pluck('kota.city_name', 'kota.city_name');

        $data['car_models'] = collect($car_models);
        $data['near_location'] = collect($near_location);
        return view('pagesv2.car_rent.index', $data);
    }

    public function request_transaction(Request $request)
    {

        $customer = [
            'name' => $request->customer_call . ' ' . $request->customer_name,
            'phone' => $request->customer_phone,
            'email' => $request->customer_email,
        ];

        $data = $request->all();

        $package = CarRentalHasCars::find($data['package_id']);
        $dateTime = $data['date'];

        $now =  Carbon::parse($dateTime)->format('Y-m-d H:i');
        $over = Carbon::parse($now)->addDays((int)$data['duration'] - 1)->addHours(12)->format('Y-m-d H:i');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('car_rent') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $package->price);


        $amount = $package->rental_price_per_day * $data['duration'];

        $kode_unik = random_int(0, 999);

        $fee = Fee::whereHas('service', function ($s) use ($data) {
            $s->where('name', $data['service']);
        })->first();
        $fees = [
            [
                'type' => 'Admin',
                'value' => $fee->percent == 0 ? $fee->value : ($amount * $fee->value) / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $kode_unik,
            ],
        ];

        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1) {
            // history point masuk dan keluar customer
            //            $pointCustomer = HistoryPoint::where('user_id', Auth::user()->id)->first();
            // point masuk - point keluar
            //            $saldoPointCustomer = $pointCustomer->where('flow', '=', 'debit')->sum('point') - $pointCustomer->where('flow', '=', 'credit')->sum('point') ?? 0;
            $saldoPointCustomer = Auth::user()->point;
            $fees = [
                [
                    'type' => 'Point',
                    'value' => $saldoPointCustomer,
                ],
            ];
        }

        $model = $package['carModel']['name'] ?? 'Deleted model';
        $brand = $package['brand']['name'] ?? 'Deleted brand';
        $business = $package['carRental']['business_name'] ?? 'Deleted business';

        // Create xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $data['package_id'],
                    'name' => $model . ' - ' . $brand . ' - ' . $business,
                    'price' => $amount, // tanpa pajak
                    'quantity' => $data['duration'],
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $kode_unik, // include pajak
            'success_redirect_url' => route('user.orderHistory'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $customer['name'],
                'email' => $customer['email'],
                'mobile_number' => $customer['phone'],
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $now, $over, $customer, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $package, $saldoPointCustomer) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'CR-' . time(),
                'service' => $data['service'],
                'service_id' => $service['id'],
                'payment' => $data['payment'],
                'user_id' => Auth::user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount + $fees[0]['value'] + $kode_unik,
            ]);
            // Pengurangan Point
            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint($request->user()->id, $saldoPointCustomer, $storeTransaction->id);
            }

            DetailTransactionCarRental::create([
                "transaction_id" => $storeTransaction->id,
                "car_rental_id" => $package['car_rental_id'],
                "car_rental_has_car_id" => $package['id'],
                "booking_id" => \Illuminate\Support\Str::random(6),
                "start" => $now,
                "end" => $over,
                "location" => strToUpper($package['carRental']['kota']['city_name'] ?? $data['location']),
                "rent_price" => $package['rental_price_per_day'],
                "fee_admin" => $fees[0]['value'],
                "duration" => $data['duration'],
                "kode_unik" => $kode_unik,
                "customer_name" => $customer['name'] ?? '-',
                "customer_phone" => $customer['phone'] ?? '-',
                "customer_email" => $customer['email'] ?? '-',
            ]);
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return redirect()->away($payoutsXendit['invoice_url']);
    }

    public function show(Request $request)
    {
        $category = $request->category;
        $location = $request->location;
        $date = $request->date ?? Carbon::now()->format('Y-m-d');
        $time = $request->time ?? '08:00';
        $duration = $request->duration;
        $model = $request->model_id;
        $car_model = $request->car_model_id;
        $search = $request->search;

        // Log request untuk debugging
        \Log::info('Car Rent Show Request:', [
            'category' => $category,
            'location' => $location,
            'model' => $model,
            'car_model' => $car_model,
            'search' => $search
        ]);

        // Jika ada parameter pencarian, cari berdasarkan nama bisnis
        if ($search) {
            $cars = CarRentalHasCars::with('brand', 'carModel', 'booked', 'carRental', 'carRental.kota')
                ->whereHas('carRental', function($q) use($search) {
                    $q->where('business_name', 'like', '%' . $search . '%');
                })
                ->get();
        } else {
            // Query konsisten untuk semua jenis pencarian
            $cars = CarRentalHasCars::with('brand', 'carModel', 'booked', 'carRental', 'carRental.kota')
                ->where(function ($query) use ($location, $category, $model, $car_model) {
                    // Filter berdasarkan lokasi
                    if ($location) {
                        $query->whereHas('carRental', function ($subQuery) use ($location) {
                            $subQuery->whereHas('kota', function ($kotaQuery) use ($location) {
                                $kotaQuery->where('city_name', 'like', '%' . $location . '%');
                            });
                        });
                    }
                    
                    // Filter berdasarkan kategori/cara rental
                    if ($category) {
                        // Konversi nilai dari form ke format yang sesuai di database
                        $dbCategory = $category;
                        if ($category == 'Dengan Driver' || $category == 'dengan driver') {
                            $dbCategory = 'Dengan Driver';
                        } elseif ($category == 'Lepas Kunci' || $category == 'Tidak Dengan Driver') {
                            $dbCategory = 'Lepas Kunci';
                        }
                        
                        $query->where('category_rent', $dbCategory);
                    }
                    
                    // Filter berdasarkan model mobil
                    if ($model) {
                        $query->where('car_model_id', $model);
                    }
                    
                    // Filter berdasarkan car_model_id (untuk favorite cars)
                    if ($car_model) {
                        $query->where('car_model_id', $car_model);
                    }
                })
                ->get();
        }

        // Log jumlah hasil
        \Log::info('Jumlah mobil ditemukan: ' . $cars->count());

        foreach ($cars as $key => $c) {
            $vendor = CarRentalHasCars::where('brand_id', $c['brand_id'])->get();
            $ven = [];
            foreach ($vendor as $key => $v) {
                $item = [
                    'car_id' => $v['id'],
                    'vendor_id' => $v['car_rental_id'],
                    'business_name' => $v['carRental']['business_name'],
                    'brand_id' => $v['brand_id'],
                    'location' => $v['carRental']['kota']['city_name'] ?? '',
                    'reviews' => $v['carRental']->reviews()->count(),
                    'avgRating' => $v['carRental']->avgRating(),
                    'price' => $v['rental_price_per_day'],
                ];

                array_push($ven, $item);
            }

            $c['vendor'] = $ven;
        }

        // Query konsisten untuk near_location - tampilkan semua kota yang memiliki rental mobil
        // Debug query untuk melihat apa yang terjadi
        \Log::info('Checking cities with car rentals...');
        
        // Query yang lebih fleksibel untuk menangani inkonsistensi data
        // Mengambil semua kota untuk memastikan data ditampilkan
        $near_location = City::orderBy('city_name')->pluck('city_name', 'city_name');
        
        // Log jumlah kota yang ditampilkan
        \Log::info('Near location count: ' . $near_location->count());
        \Log::info('Near locations: ' . json_encode($near_location->toArray()));

        $data['cars'] = $cars;
        $data['location'] = $location;
        $data['category'] = $category;
        $data['model'] = $model;
        $data['car_model'] = $car_model;
        $data['date'] = $date;
        $data['time'] = $time;
        $data['duration'] = $duration;
        $data['near_location'] = $near_location;
        return view('pagesv2.car_rent.show', $data);
    }

    public function detail(Request $request, $category, $lokasi, $model, $provider, $date, $duration)
    {
        $data['car'] = CarRentalHasCars::with(['brand', 'carModel', 'carRental', 'carRentalRate', 'policy'])->where('id', $provider)->first();
        $data['date'] = $date;
        $data['category'] = $category;
        $data['lokasi'] = $lokasi;
        $data['model'] = $model;
        $data['provider'] = $provider;
        $data['duration'] = $duration;
        $data['service_id'] = Service::where('name', 'car-rent')->first()['id'];;

        return view('pagesv2.car_rent.detail', $data);
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $data['car'] = CarRentalHasCars::with(['brand', 'carRental', 'carModel', 'policy'])->where('id', $request->car_id)->first();
            $data['duration'] = $request->duration;
            $data['date'] = Carbon::parse($request->date)->format('Y-m-d H:i');
            $data['category'] = $request->category;
            $data['user'] = $user;
            $data['provider'] = $request->provider;
            $data['service_id'] = Service::where('name', 'car-rent')->first()['id'];
            $data['cities'] = City::orderBy('city_name', 'DESC')->get();

            return view('pagesv2.car_rent.order', $data);
        } else {
            return redirect()->route('login');
        }
        // $data['paket'] = [];
        // return view('pagesv2.car_rent.order', $data);
    }

    public function getVendorCars($brand_id, $city_id)
    {
        if (!is_numeric($brand_id)) {
            return response()->json(['error' => 'Invalid ID Brand']);
        }

        if (!is_numeric($city_id)) {
            return response()->json(['error' => 'Invalid ID City']);
        }

        $car_vendors = CarRentalHasCars::with('carRental')->where('brand_id', $brand_id)->get();

        return response()->json(['data' => $car_vendors]);
    }
}

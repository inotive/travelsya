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

        $near_location = CarRental::with('kota')->get()->pluck('kota.city_name', 'kota.city_name');

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

        // First try to find the city by name to get the city_id
        $city = null;
        if ($location) {
            // Use case-insensitive search for city name
            $city = City::whereRaw('LOWER(city_name) LIKE ?', ['%' . strtolower($location) . '%'])->first();
        }

        // Get cars with their relationships
        $cars = CarRentalHasCars::with('brand', 'carModel', 'booked', 'carRental')
            ->when($city, function ($query) use ($city) {
                // Filter by city_id if we found a matching city
                $query->whereHas('carRental', function ($q) use ($city) {
                    $q->where('city', $city['city_id']);
                });
            })
            ->when($category, function ($query, $c) {
                // Filter by category
                $query->where('category_rent', $c);
            })
            ->when($model, function ($query, $m) {
                // Filter by car model
                $query->where('car_model_id', $m);
            })
            ->when($car_model, function ($query, $m) {
                // Filter by car model (alternative field)
                $query->where('car_model_id', $m);
            })
            ->get();

        // Process each car to get vendor information
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

        // Prepare data for the view
        $data['cars'] = $cars;
        $data['location'] = $location;
        $data['category'] = $category;
        $data['model'] = $model;
        $data['car_model'] = $car_model;
        $data['date'] = $date;
        $data['time'] = $time;
        $data['duration'] = $duration;

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

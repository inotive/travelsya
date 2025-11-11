<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use PHPUnit\Exception;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use App\Models\City;
use App\Models\CarRentalRating;
use App\Models\DetailTransactionCarRental;
use App\Models\Fee;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class CarRentalController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function carRentalCity()
    {
        $cityIds = CarRental::distinct()->pluck('city')->filter();
        $cities = City::whereIn('city_id', $cityIds)->pluck('city_name');

        if ($cities->isEmpty()) {
            return ResponseFormatter::error(null, 'Data not found');
        }

        return ResponseFormatter::success($cities, 'Data successfully loaded');
    }

    public function index(Request $request)
    {
        try {
            $kota = $request->input('kota');
            $tanggalAwal = $request->input('tanggal_awal');
            $durasi = $request->input('durasi');
            $jamPengambilan = $request->input('jam_pengambilan');
            $categoryRent = $request->input('category_rent');

            $carRentals = DB::table('car_rental_has_cars')
                ->join('car_models', 'car_rental_has_cars.car_model_id', '=', 'car_models.id')
                ->join('brands', 'car_rental_has_cars.brand_id', '=', 'brands.id')
                ->join('car_rentals', 'car_rental_has_cars.car_rental_id', '=', 'car_rentals.id')
                ->select(
                    'car_models.name as car_model_name',
                    'brands.name as car_brand_name',
                    'car_rental_has_cars.image_url as img',
                    'car_rental_has_cars.number_seats as number_seat',
                    'car_rental_has_cars.category_rent as category_rent',
                    'car_rental_has_cars.category as category',
                    DB::raw('MIN(car_rental_has_cars.rental_price_per_day) as min_price')
                )
                ->where('car_rentals.city', 'like', '%' . $kota . '%');

            if (!is_null($categoryRent)) {
                if ($categoryRent === true) {
                    $carRentals->where('car_rental_has_cars.category_rent', 'lepas kunci');
                } else {
                    $carRentals->where('car_rental_has_cars.category_rent', 'dengan kunci');
                }
            }

            $carRentalData = $carRentals
                ->groupBy(
                    'car_models.name',
                    'brands.name',
                    'car_rental_has_cars.image_url',
                    'car_rental_has_cars.number_seats',
                    'car_rental_has_cars.category_rent',
                    'car_rental_has_cars.category'
                )
                ->get();

            if ($carRentalData->isNotEmpty()) {
                return ResponseFormatter::success($carRentalData, 'Data successfully loaded');
            } else {
                return ResponseFormatter::success([], 'Data successfully loaded');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Car rental process failed', 500);
        }
    }

    public function cari(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'location' => 'required',
        //     'date' => 'required|date',
        //     'duration' => 'required',
        //     'with_driver' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return ResponseFormatter::error(
        //         [
        //             'response' => $validator->errors(),
        //         ],
        //         'Recreation process failed',
        //         500,
        //     );
        // }

        $data = $request->all();

        $transmisi = $data['transmisi'] ?? null;

        $type = "Tidak Dengan Drive";
        $start = $data['date'] ?? null;
        $city = $data['location'] ?? null;
        $duration = $data['duration'] ?? null;

        if ($transmisi !== null) {
            $transmisi = $data['transmisi'] == 'otomatis' ? 'automatic' : 'manual';
            $filter = $data['transmisi'];
        } else {
            $transmisi = null;
            $filter = 'semua';
        }

        if (isset($data['with_driver']) && $data['with_driver'] == 1) {
            $type = "Dengan Driver";
        } else {
            $type = null;
        }

        // $carRentals = CarRentalHasCars::Active()
        //     ->with('carModel', 'brand', 'carRental')
        //     ->whereDoesntHave('booked', function ($q) use ($start) {
        //         $q->whereDate('start', '>', $start);
        //     })
        //     ->whereDoesntHave('booked', function ($q) use ($start) {
        //         $q->whereDate('end', $start);
        //     })
        //     ->whereHas('carRental', function ($c) use ($city) {
        //         $c->whereHas('kota', function ($k) use ($city) {
        //             $k->where('city_name', 'like', '%' . $city . '%');
        //         });
        //     })
        //     ->get();

        // return [$type, $transmisi, $city];

        $carRentals = CarRentalHasCars::Active()
            ->with('carModel', 'brand', 'carRental')
            ->when($type, function ($t, $type) {
                $t->where('category_rent', $type);
            })
            ->when($transmisi, function ($t, $trans) {
                $t->where('category', $trans);
            })
            ->when($city, function ($d, $city) {
                $d->whereHas('carRental', function ($c) use ($city) {
                    $c->whereHas('kota', function ($k) use ($city) {
                        $k->where('city_name', 'like', '%' . $city . '%');
                    });
                });
            })
            ->orderBy('rental_price_per_day', 'asc')
            ->get();

        $newData = [
            'filter' => $filter,
            'cars' => []
        ];

        if ($carRentals->isNotEmpty()) {

            foreach ($carRentals as $key => $val) {
                $item = [
                    'id' => $val['id'],
                    'business_name' => $val['carRental']['business_name'] ?? 'Deleted Business',
                    'city' => $val['carRental']['kota']['city_name'] ?? 'Deleted Business',
                    'car_model' => $val['carModel']['name'] ?? 'deleted model',
                    'car_brand' => $val['brand']['name'] ?? 'deleted brand',
                    'chairs' => $val['number_seats'],
                    'transmisi' => $val['category'],
                    'category_rent' => $val['catgeory_rent'] == 'Tidak Dengan Driver' ? 'Lepas Kunci' : 'Dengan Driver',
                    'image' => $val['image_url'] ? asset('storage/' . (Str::startsWith($val['image_url'], 'cars/') ? $val['image_url'] : 'cars/' . $val['image_url'])) : asset('images/not_found.jpg'),
                    'price' => $val['rental_price_per_day'],
                ];

                array_push($newData['cars'], $item);
            }
        }

        return ResponseFormatter::success($newData, 'Data successfully loaded');
    }

    public function cari2(Request $request)
    {
        $data = $request->all();

        // Clean input extraction
        $transmisiInput = $data['transmisi'] ?? null;
        $city = $data['location'] ?? null;
        $withDriver = isset($data['with_driver']) && $data['with_driver'] == 1;

        // Determine transmission and filter
        if ($transmisiInput !== null) {
            $transmisi = $transmisiInput === 'otomatis' ? 'automatic' : 'manual';
            $filter = $transmisiInput;
        } else {
            $transmisi = null;
            $filter = 'semua';
        }

        // Determine rental type
        $type = $withDriver ? 'Dengan Driver' : null;

        // Build query
        $brands = Brand::with(['vendor.carModel', 'vendor.brand', 'vendor.carRental'])
            ->when($type, function ($query, $type) {
                $query->whereHas('vendor', function ($q) use ($type) {
                    $q->where('category_rent', $type);
                });
            })
            ->when($transmisi, function ($query, $transmisi) {
                $query->whereHas('vendor', function ($q) use ($transmisi) {
                    $q->where('category', $transmisi);
                });
            })
            ->when($city, function ($query, $city) {
                $query->whereHas('vendor', function ($q) use ($city) {
                    $q->whereHas('carRental', function ($q2) use ($city) {
                        $q2->whereHas('kota', function ($q3) use ($city) {
                            $q3->where('city_name', 'like', '%' . $city . '%');
                        });
                    });
                });
            })
            ->get();

        $result = [
            'brand' => [],
            'vendor' => [],
        ];

        foreach ($brands as $brandKey => $brand) {
            if ($brand->vendor->isEmpty()) {
                continue;
            }

            $firstVendor = $brand->vendor->first();

            $brandName = ($firstVendor->carModel->name ?? 'Invalid Car Model') . ' ' . ($firstVendor->brand->name ?? 'Invalid Brand');

            $item = [
                'brand_id'    => $brand->id,
                'brand'       => $brandName,
                'seats'       => $firstVendor->number_seats ?? null,
                'price'       => $firstVendor->rental_price_per_day ?? null,
                'transmission'=> $firstVendor->category ?? null,
                'image'       => !empty($firstVendor->image_url) ? asset('storage/' . (Str::startsWith($firstVendor->image_url, 'cars/') ? $firstVendor->image_url : 'cars/' . $firstVendor->image_url)) : asset('images/not_found.jpg'),
            ];

            $subVendors = [];
            foreach ($brand->vendor as $vendor) {
                $subVendors[] = [
                    'id_car'        => $vendor->id,
                    'business_name' => $vendor->carRental->business_name ?? 'Deleted Business',
                    'price'         => $vendor->rental_price_per_day,
                ];
            }

            $result['brand'][$brandKey] = $item;
            $result['vendor'][$brandName] = $subVendors;
        }

        return ResponseFormatter::success($result, 'Data successfully loaded');
    }

    public function postRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bintang' => 'required',
            'transaction_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Review Clinic process failed',
                500,
            );
        }

        $transaction = Transaction::with('detailTransactionCarRent')->find($request->transaction_id);

        if ($transaction) {

            CarRentalRating::create([
                'car_rental_id'      => $transaction->detailTransactionCarRent->car_rental_id,
                'transaction_id' => $request->transaction_id,
                'car_rental_has_car_id' => $transaction->detailTransactionCarRent->car_rental_has_car_id,
                'user_id'      => auth()->id(),
                'rate'          => $request->bintang,
                'comment'       => $request->review,
            ]);

            return ResponseFormatter::success([], 'Review Rekreasi Telah Berhasil Dikirim');
        } else {
            return ResponseFormatter::error([], 'Transaksi tidak ditemukan');
        }
    }

    public function requestTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'payment' => 'required|string',
            'package_id' => 'required',
            'point' => 'required',
            'date' => 'required|date',
            'duration' => 'required|integer',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string',
            'is_same' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Car Rental process failed',
                500,
            );
        }

        if ($request->is_same == 0 || $request->is_same == "0") {
            $validator = Validator::make($request->all(), [
                'customer_call' => 'required',
                'customer_name' => 'required',
                'customer_phone' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Car Rental process failed',
                    500,
                );
            }

            $customer = [
                'name' => $request->customer_call . ' ' . $request->customer_name,
                'phone' => $request->customer_phone,
                'email' => $request->customer_email,
            ];
        } else {
            $customer = [
                'name' => Auth::user()->name,
                'phone' => Auth::user()->phone ?? '000000000000',
                'email' => Auth::user()->email,
            ];
        }

        $data = $request->all();

        $package = CarRentalHasCars::find($data['package_id']);
        $dateTime = $data['date'] . ' ' . $data['time'];

        $now =  Carbon::parse($dateTime)->format('Y-m-d H:i');
        $over = Carbon::parse($now)->addDays($data['duration'])->format('Y-m-d H:i');

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
            'success_redirect_url' => route('redirect.succes'),
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
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function detail_car($id)
    {
        $car = CarRentalHasCars::with('carModel', 'brand', 'carRental')->find($id);

        if ($car) {
            $data = [
                'id' => $car['id'],
                'service' => 'car-rent',
                'business_name' => $car['carRental']['business_name'] ?? 'Deleted business name',
                'car_model' => $car['carModel']['name'] ?? 'deleted model',
                'car_brand' => $car['brand']['name'] ?? 'deleted brand',
                'category_rent' => $car['category_rent'] == 'Tidak Dengan Driver' ? 'Lepas Kunci' : 'Dengan Sopir',
                'chairs' => $car['number_seats'],
                'transmisi' => $car['category'],
                'image' => $car['image_url'] ? asset('storage/' . (Str::startsWith($car['image_url'], 'cars/') ? $car['image_url'] : 'cars/' . $car['image_url'])) : asset('images/not_found.jpg'),
                'price' => $car['rental_price_per_day'],
            ];

            return ResponseFormatter::success($data, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error([], 'Data Not Found');
        }
    }
}

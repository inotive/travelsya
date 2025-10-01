<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\ClinicHasPackages;
use App\Models\ClinicRating;
use App\Models\City;
use App\Models\DetailTransactionHealthBeauty;
use App\Models\Fee;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting as ServicesSetting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class HealthBeautyController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function detail($id)
    {
        $clinic = Clinic::with('reviews', 'packages', 'kota', 'image')->find($id);

        if ($clinic) {
            $images = $clinic['images'];

            $newImages = [];

            foreach ($images as $key => $value) {
                $img = asset('storage/' . $value['image']);
                array_push($newImages, $img);
            }

            $item = [
                'clinic_id' => $clinic['id'],
                'category' => $clinic['category'],
                'user' => $clinic['user']['name'] ?? 'invalid user',
                'name' => $clinic['clinic_name'],
                'description' => $clinic['description'],
                'highlight' => $clinic['highlight'],
                'buka' => $clinic['open'],
                'tutup' => $clinic['close'],
                'city' => $clinic['kota']['city_name'] ?? 'Kota dihapus',
                'address' => $clinic['address'],
                'latitude' => $clinic['lat'],
                'longitude' => $clinic['ltd'],
                'images' => $newImages,
                'main_image' => isset($clinic['image']) && isset($clinic['image']['image']) ? asset('storage/images/clinic_package_images/' . $clinic['image']['image']) : asset('images/not_found.jpg'),
                'packages' => $clinic['packages'],
                'rating_count' => count($clinic['reviews']),
                'avg_rating' => $clinic->avgRating(),
                'comments' => $clinic['reviews']
            ];

            $random = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->inRandomOrder()->limit(10)->get();

            $newRandom = [];

            foreach ($random as $key => $rec) {
                if (count($rec['packages']) > 0) {
                    $new = [
                        'id' => $rec['id'],
                        'name' => $rec['clinic_name'],
                        'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image']) : asset('not_found.png'),
                        'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'category' => $rec['category'],
                        'unit_price' => $rec['packages'][0]['unit_price'],
                        'price' => $rec['packages'][0]['price'],
                        'rating_count' => count($rec['reviews']),
                        'avg_rating' => $rec->avgRating(),
                    ];

                    array_push($newRandom, $new);
                }
            }

            $data['show'] = $item;
            $data['mungkin_suka'] = $newRandom;

            return ResponseFormatter::success($data, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error([], 'clinic not found');
        }
    }

    public function postRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required',
            'package_id' => 'required',
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

        ClinicRating::create([
            'clinic_id'      => $request->clinic_id,
            'transaction_id' => $request->transaction_id,
            'clinic_package_id' => $request->package_id,
            'user_id'      => auth()->id(),
            'rate'          => $request->bintang,
            'comment'       => $request->review,
        ]);

        return ResponseFormatter::success([], 'Review Rekreasi Telah Berhasil Dikirim');
    }

    public function requestTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'payment' => 'required|string',
            'package_id' => 'required',
            'point' => 'required',
            'total_ticket' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Clinic process failed',
                500,
            );
        }

        $data = $request->all();

        $package = ClinicHasPackages::find($data['package_id']);

        $now =  date('Y-m-d');

        $expire = Carbon::parse($now)->addDays($package['expiry_date'])->addHours(23)->format('Y-m-d H:i:s');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('healthbeauty') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new ServicesSetting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $package->price);


        $amount = $package->price * $data['total_ticket'];

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

        // Create xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $data['package_id'],
                    'name' => $package['name'] ?? 'Invalid clinic',
                    'price' => $amount, // tanpa pajak
                    'quantity' => $data['total_ticket'],
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $kode_unik, // include pajak
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => Auth::user()->name,
                'email' => Auth::user()->email,
                'mobile_number' => Auth::user()->phone ?? '000000000000',
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $expire, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $package, $saldoPointCustomer) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HNB-' . time(),
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

            DetailTransactionHealthBeauty::create([
                "transaction_id" => $storeTransaction->id,
                "clinic_id" => $package['clinic_id'],
                "clinic_package_id" => $package['id'],
                "category" => $package['clinic']['category'] ?? 'Deleted clinic',
                "booking_id" => Str::random(6),
                "expire_on" => $expire,
                "rent_price" => $package->price,
                "fee_admin" => $fees[0]['value'],
                "kode_unik" => $kode_unik,
                "total_ticket" => $data['total_ticket'],
                "is_used" => 0,
            ]);

            try {
                // $storeDetailTransaction = DB::table('detail_transaction_recreations')->insert([
                //     "transaction_id" => $storeTransaction->id,
                //     "recreation_id" => $package['recreation_id'],
                //     "recreationPackage_id" => $package['id'],
                //     "booking_id" => Str::random(6),
                //     "expire_on" => $expire,
                //     "rent_price" => $package->price,
                //     "fee_admin" => $fees[0]['value'],
                //     "kode_unik" => $kode_unik,
                //     "is_used" => 0,
                //     'created_at' => Carbon::now()->timezone('Asia/Makassar'),
                // ]);

                // DetailTransactionHealthBeauty::create([
                //     "transaction_id" => $storeTransaction->id,
                //     "clinic_id" => $package['clinic_id'],
                //     "clinic_package_id" => $package['id'],
                //     "category" => $package['clinic']['category'] ?? 'Deleted clinic',
                //     "booking_id" => Str::random(6),
                //     "expire_on" => $expire,
                //     "rent_price" => $package->price,
                //     "fee_admin" => $fees[0]['value'],
                //     "kode_unik" => $kode_unik,
                //     "is_used" => 0,
                // ]);
            } catch (Throwable $e) {
                return response()->json([
                    'status' => 'Error Store Data Transaction',
                    'massage' => $e
                ]);
            }
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function healthHome(Request $request)
    {
        $city = '%' . $request->location . '%';
        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'kesehatan')
            ->limit(10)
            ->get();

        $cantik = [];
        // return $special;
        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => (int)$rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($cantik, $item);
            }
        }

        $data['categories'] = $special->pluck('category')->unique()->toArray();
        $data['special_deals'] = $cantik;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function beautyHome(Request $request)
    {
        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'kecantikan')
            // ->whereHas('packages', function ($p) {
            //     $p->whereColumn('unit_price', '>', 'price');
            // })
            // ->when($city, function ($c, $cit) {
            //     $c->whereHas('kota', function ($k) use ($cit) {
            //         $k->where('city_name', 'like', $cit);
            //     });
            // })
            ->limit(10)
            ->get();

        $cantik = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => (int)$rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($cantik, $item);
            }
        }

        $category = CategoriesServices::select('id', 'name')->get();

        $data['categories'] = $category;
        $data['special_deals'] = $cantik;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function spaHome(Request $request)
    {
        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'spa dan kecantikan')
            // ->whereHas('packages', function ($p) {
            //     $p->whereColumn('unit_price', '>', 'price');
            // })
            // ->when($city, function ($c, $cit) {
            //     $c->whereHas('kota', function ($k) use ($cit) {
            //         $k->where('city_name', 'like', $cit);
            //     });
            // })
            ->limit(10)
            ->get();

        $cantik = [];
        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => (int)$rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($cantik, $item);
            }
        }
        $category = CategoriesServices::select('id', 'name')->get();

        $data['categories'] = $category;
        $data['special_deals'] = $cantik;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function search(Request $request)
    {
        $city = '%' . $request->location . '%';
        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'kesehatan')
            ->whereHas('packages', function ($p) {
                $p->whereColumn('unit_price', '>', 'price');
            })
            ->when($request->name, function ($c, $cit) {
                $c->where('clinic_name', 'like', '%' . $cit . '%');
            })
            ->when($city, function ($c, $cit) {
                $c->whereHas('kota', function ($k) use ($cit) {
                    $k->where('city_name', 'like', $cit);
                });
            })
            ->get();
        $cantik = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('storage/' . $rec['image']['image']) : asset('images/not_found.jpg'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => $rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($cantik, $item);
            }
        }

        $data['clinic'] = $cantik;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function beauty_search(Request $request)
    {
        $city = '%' . $request->location . '%';
        $req = $request->name;

        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'kecantikan')
            ->whereHas('packages')
            ->when($request->name, function ($c, $req) {
                $c->where('clinic_name', 'like', '%' . $req . '%');
            })
            ->when($city, function ($c, $cit) {
                $c->whereHas('kota', function ($k) use ($cit) {
                    $k->where('city_name', 'like', $cit);
                });
            })
            ->get();

        $cantik = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('storage/' . $rec['image']['image']) : asset('images/not_found.jpg'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => $rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($cantik, $item);
            }
        }

        $data['clinic'] = $cantik;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function spa_search(Request $request)
    {
        $city = '%' . $request->location . '%';
        $req = $request->name;

        $special = Clinic::Active()->with('reviews', 'packages', 'kota', 'image')->where('category', 'spa dan kecantikan')
            ->whereHas('packages')
            ->when($request->name, function ($c, $req) {
                $c->where('clinic_name', 'like', '%' . $req . '%');
            })
            ->when($city, function ($c, $cit) {
                $c->whereHas('kota', function ($k) use ($cit) {
                    $k->where('city_name', 'like', $cit);
                });
            })
            ->get();

        $spa = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['clinic_name'],
                    'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('storage/' . $rec['image']['image']) : asset('images/not_found.jpg'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'category' => $rec['category'],
                    'unit_price' => $rec['packages'][0]['unit_price'],
                    'price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($spa, $item);
            }
        }

        $data['clinic'] = $spa;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function clinicCity()
    {
        $cityIds = Clinic::distinct()->pluck('city')->filter();
        $hostelCity = City::whereIn('city_id', $cityIds)->pluck('city_name');

        if ($hostelCity->isEmpty()) {
            return ResponseFormatter::error(null, 'Data not found');
        }

        return ResponseFormatter::success($hostelCity, 'Data successfully loaded');
    }

    public function list()
    {
        $datas = Clinic::active()->with('reviews', 'packages', 'kota', 'image')->get();

        $kesehatan = [];
        $cantik = [];
        $spa = [];

        foreach ($datas as $key => $rec) {
            if (count($rec['packages']) > 0) {
                if ($rec['category'] == "kesehatan") {
                    $item = [
                        'id' => $rec['id'],
                        'name' => $rec['clinic_name'],
                        'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                        'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'category' => $rec['category'],
                        'unit_price' => $rec['packages'][0]['unit_price'],
                        'price' => $rec['packages'][0]['price'],
                        'rating_count' => count($rec['reviews']),
                        'avg_rating' => $rec->avgRating(),
                    ];

                    array_push($kesehatan, $item);
                } elseif ($rec['category'] == "kecantikan") {
                    $item2 = [
                        'id' => $rec['id'],
                        'name' => $rec['clinic_name'],
                        'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                        'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'category' => $rec['category'],
                        'unit_price' => $rec['packages'][0]['unit_price'],
                        'price' => $rec['packages'][0]['price'],
                        'rating_count' => count($rec['reviews']),
                        'avg_rating' => $rec->avgRating(),
                    ];

                    array_push($cantik, $item2);
                } elseif ($rec['category'] == "spa dan kecantikan") {
                    $item3 = [
                        'id' => $rec['id'],
                        'name' => $rec['clinic_name'],
                        'image' => isset($rec['image']) && isset($rec['image']['image']) ? asset('public/storage/images/clinic_package_images/' . $rec['image']['image'])  : asset('not_found.png'),
                        'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'category' => $rec['category'],
                        'unit_price' => $rec['packages'][0]['unit_price'],
                        'price' => $rec['packages'][0]['price'],
                        'rating_count' => count($rec['reviews']),
                        'avg_rating' => $rec->avgRating(),
                    ];

                    array_push($spa, $item3);
                }
            }
        }

        $data['category'] = ['kecantikan', 'kesehatan', 'spa dan kecantikan'];
        $data['kesehatan'] = $kesehatan;
        $data['kecantikan'] = $cantik;
        $data['spa dan kecantikan'] = $spa;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ResponseFormatter;
use App\Models\CategoryRecreation;
use App\Models\detailTransactionRecreation;
use App\Models\Fee;
use App\Models\Recreation;
use App\Models\RecreationPackages;
use App\Models\RecreationRatings;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;
use Throwable;

class RecreationController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function postRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recreation_id' => 'required',
            'package_id' => 'required',
            'bintang' => 'required',
            'transaction_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Review Recreation process failed',
                500,
            );
        }

        RecreationRatings::create([
            'recreation_id'      => $request->recreation_id,
            'transaction_id' => $request->transaction_id,
            'recreation_packages_id' => $request->package_id,
            'users_id'      => auth()->id(),
            'rate'          => $request->bintang,
            'comment'       => $request->review,
        ]);

        return ResponseFormatter::success([], 'Review Rekreasi Telah Berhasil Dikirim');
    }

    public function index(Request $request)
    {
        try {
            $keywords = $request->input('keywords');
            $category = $request->input('category');

            $recreations = DB::table('recreations')
                ->join('recreation_has_packages', 'recreations.id', '=', 'recreation_has_packages.recreation_id')
                ->leftJoin(DB::raw('(SELECT recreation_id, AVG(rate) as average_rating, COUNT(id) as total_ratings FROM recreation_ratings GROUP BY recreation_id) as ratings'), 'recreations.id', '=', 'ratings.recreation_id')
                ->select(
                    'recreations.id',
                    'recreations.business_name as name',
                    'recreations.city as city',
                    DB::raw('MIN(recreation_has_packages.price) as min_price'),
                    DB::raw('IFNULL(ratings.average_rating, 0) as average_rating'),
                    DB::raw('IFNULL(ratings.total_ratings, 0) as total_ratings')
                )
                ->where('recreations.is_active', 1);

            if (!is_null($keywords)) {
                $recreations->where('recreations.business_name', 'like', '%' . $keywords . '%');
            }

            if (!is_null($category)) {
                $recreations->where('recreation_has_packages.category_recreation_id', $category);
            }
            $recreations->groupBy(
                'recreations.id',
                'recreations.business_name',
                'recreations.city',
                'ratings.average_rating',
                'ratings.total_ratings'
            );

            $recreationData = $recreations->get();

            if ($recreationData->isNotEmpty()) {
                return ResponseFormatter::success($recreationData, 'Data successfully loaded');
            } else {
                return ResponseFormatter::success([], 'No data found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Failed to load recreation data', 500);
        }
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
                'Recreation process failed',
                500,
            );
        }

        $data = $request->all();

        $package = RecreationPackages::find($data['package_id']);

        $now =  date('Y-m-d');

        if (strTolower($package['expiry_type']) == 'hari') {
            $expire = Carbon::parse($now)->addDays($package['expiry_date'])->addHours(23)->format('Y-m-d H:i:s');
        } else {
            $expire = Carbon::now()->addHours($package['expiry_date'])->format('Y-m-d H:i:s');
        }

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('recreation') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $package->price);


        $amount = $package->price * $data['total_ticket'];

        $kode_unik = random_int(0, 999);

        $fee = Fee::where('service_id', 8)->first();
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
                    'name' => $package['name'] ?? 'Invalid recreation',
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
                'req_id' => 'REC-' . time(),
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

                detailTransactionRecreation::create([
                    "transaction_id" => $storeTransaction->id,
                    "recreation_id" => $package['recreation_id'],
                    "recreationPackage_id" => $package['id'],
                    "booking_id" => Str::random(6),
                    "expire_on" => $expire,
                    "rent_price" => $package->price,
                    "fee_admin" => $fees[0]['value'],
                    "kode_unik" => $kode_unik,
                    "is_used" => 0,
                ]);
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

    public function search(Request $request)
    {
        $find = $request->all();

        $data = [
            [
                "id" => 1,
                "name" => "Tiket Trans Studio Banjarmasin",
                "city" => "Banjarmasin",
                "image" => asset('images/ts.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2000,
                "price" => 200000,
                "discount" => 25,
            ],
        ];

        $data = Recreation::with('kota', 'recreationPackages', 'reviews')->when($find['location'], function ($q) use ($find) {
            $q->whereHas('kota', function ($k) use ($find) {
                $k->where('city_name', 'like', '%' . $find['location'] . '%');
            });
        })->get();

        $newData = [];

        foreach ($data as $key => $dat) {
            if (count($dat['recreationPackages']) > 0) {
                $item = [
                    'id' => $dat['id'],
                    'name' => $dat['business_name'],
                    'image' => asset('storage/' . $dat['image']['image'] ?? 'not_found.png'),
                    'location' => $dat['kota']['city_name'] ?? 'Kota dihapus',
                    'price' => $dat['recreationPackages'][0]['price'],
                    'rating_count' => count($dat['reviews']),
                    'avg_rating' => $dat->avgRating(),
                ];

                array_push($newData, $item);
            }
        }

        return ResponseFormatter::success($newData, 'Data successfully loaded');
    }

    public function recreation_by_category($id)
    {
        $category = CategoryRecreation::find($id);

        if ($category) {
            $recreations = Recreation::active()->where('category_recreation_id', $id)->with('reviews', 'recreationPackages', 'kota')->get();
            $recre = [];

            foreach ($recreations as $key => $rec) {
                if (count($rec['recreationPackages'])) {
                    $item = [
                        'name' => $rec['business_name'],
                        'image' => asset('storage/' . $rec['image']['image'] ?? 'not_found.png'),
                        'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'price' => $rec['recreationPackages'][0]['price'],
                        'rating_count' => count($rec['reviews']),
                        'avg_rating' => $rec->avgRating(),
                    ];

                    array_push($recre, $item);
                }
            }

            $data['category_name'] = $category['name'];
            $data['category'] = CategoryRecreation::select('id', 'name')->get()->toArray();
            $data['recreations'] = $recre;

            return ResponseFormatter::success($data, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error([], 'Category not found');
        }
    }

    public function detail_recreations($id)
    {
        $recreation = Recreation::with('reviews', 'recreationPackages', 'kota')->find($id);

        if ($recreation) {
            $images = $recreation['images'];
            $newImages = [];
            foreach ($images as $key => $value) {
                $img = asset('storage/' . $value['image']);
                array_push($newImages, $img);
            }
            $item = [
                'recreation_id' => $recreation['id'],
                'service' => 'recreation',
                'category' => $recreation['category']['name'] ?? 'invalid category',
                'user' => $recreation['user']['name'] ?? 'invalid user',
                'name' => $recreation['business_name'],
                'description' => $recreation['description'],
                'buka' => $recreation['open'],
                'tutup' => $recreation['close'],
                'city' => $recreation['kota']['city_name'] ?? 'Kota dihapus',
                'address' => $recreation['address'],
                'latitude' => $recreation['lat'],
                'longitude' => $recreation['ltd'],
                'rating_count' => count($recreation['reviews']),
                'avg_rating' => $recreation->avgRating(),
                'images' => $newImages,
                'packages' => $recreation['recreationPackages'],
                'comments' => $recreation['reviews']
            ];

            return ResponseFormatter::success($item, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error([], 'Recreation not found');
        }
    }

    // new list
    public function list2()
    {
        $recreations = Recreation::active()->with('reviews', 'recreationPackages', 'kota')->get();


        $recre = [];

        foreach ($recreations as $key => $rec) {
            if (count($rec['recreationPackages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['business_name'],
                    'image' => asset('storage/' . $rec['image']['image'] ?? 'not_found.png'),
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'unit_price' => $rec['recreationPackages'][0]['unit_price'],
                    'price' => $rec['recreationPackages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($recre, $item);
            }
        }

        $data['category'] = CategoryRecreation::select('id', 'name')->get()->toArray();
        $data['recreations'] = $recre;

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    // old list
    public function list()
    {

        $data['special_deals'] = [
            [
                "id" => 1,
                "name" => "Tiket Trans Studio Banjarmasin",
                "city" => "Banjarmasin",
                "image" => asset('images/ts.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2000,
                "price" => 200000,
                "discount" => 25,
            ],
            [
                "id" => 2,
                "name" => "Tiket Trans Studio Pontianak",
                "city" => "Pontianak",
                "image" => asset('images/ts.jpg'),
                "avg_rating" => "4.2",
                "rating_count" => 1800,
                "price" => 150000,
                "discount" => 10,
            ],
            [
                "id" => 3,
                "name" => "Jakarta Aquarium Safari",
                "city" => "Jakarta",
                "image" => asset('images/jas.jpg'),
                "avg_rating" => "4.3",
                "rating_count" => 3000,
                "price" => 250000,
                "discount" => 50,
            ],
            [
                "id" => 4,
                "name" => "Taman Safari Bogor",
                "city" => "Bogor",
                "image" => asset('images/tsi.jpg'),
                "avg_rating" => "4.9",
                "rating_count" => 5000,
                "price" => 200000,
                "discount" => 15,
            ],
            [
                "id" => 5,
                "name" => "Taman Impian Jaya Ancol",
                "city" => "Jakarta",
                "image" => asset('images/ancol.jpeg'),
                "avg_rating" => "4.6",
                "rating_count" => 12000,
                "price" => 120000,
                "discount" => 2,
            ],
        ];

        $kategori_rekreasi = CategoryRecreation::select('id', 'name')->get()->toArray();

        foreach ($kategori_rekreasi as $key => $kat) {
            $kategori_rekreasi[$key]['images'] = asset('images/' . strToLower(str_replace(' ', '_', $kat['name'])) . ".png");
        }

        $data['kategori_rekreasi'] = $kategori_rekreasi;

        $data['best_recreation'] = [
            [
                "id" => 1,
                "name" => "Jakarta Aquarium Safari",
                "city" => "Jakarta",
                "image" => asset('images/jas.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2000,
                "price" => 200000,
                "discount" => 25,
            ],
            [
                "id" => 2,
                "name" => "Sea World Ancol",
                "city" => "Jakarta",
                "image" => asset('images/jas.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2100,
                "price" => 180000,
                "discount" => 15,
            ],
            [
                "id" => 3,
                "name" => "Pondok Indah Waterpark",
                "city" => "Jakarta",
                "image" => asset('images/jas.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2100,
                "price" => 250000,
                "discount" => 15,
            ],
            [
                "id" => 4,
                "name" => "Dunia Fantasi Ancol",
                "city" => "Jakarta",
                "image" => asset('images/jas.jpg'),
                "avg_rating" => "4.8",
                "rating_count" => 2100,
                "price" => 250000,
                "discount" => 15,
            ],
        ];

        return ResponseFormatter::success($data, 'Data successfully loaded');
    }

    public function show($id)
    {
        try {
            $recreation = DB::table('recreations')
                ->join('recreation_has_packages', 'recreations.id', '=', 'recreation_has_packages.recreation_id')
                ->leftJoin(DB::raw('(SELECT recreation_id, AVG(rate) as average_rating, COUNT(id) as total_ratings FROM recreation_ratings GROUP BY recreation_id) as ratings'), 'recreations.id', '=', 'ratings.recreation_id')
                ->select(
                    'recreations.id',
                    'recreations.business_name as name',
                    'recreations.city as city',
                    'recreations.address',
                    DB::raw('MIN(recreation_has_packages.price) as min_price'),
                    DB::raw('IFNULL(ratings.average_rating, 0) as average_rating'),
                    DB::raw('IFNULL(ratings.total_ratings, 0) as total_ratings')
                )
                ->where('recreations.id', $id)
                ->where('recreations.is_active', 1)
                ->groupBy(
                    'recreations.id',
                    'recreations.business_name',
                    'recreations.city',
                    'recreations.address',
                    'ratings.average_rating',
                    'ratings.total_ratings'
                )
                ->first();

            if (!$recreation) {
                return ResponseFormatter::error('Recreation not found', 404);
            }

            $packages = DB::table('recreation_has_packages')
                ->select('id', 'name', 'price',)
                ->where('recreation_id', $id)
                ->get();

            $reviews = DB::table('recreation_ratings')
                ->join('users', 'recreation_ratings.users_id', '=', 'users.id')
                ->select(
                    'recreation_ratings.id',
                    'recreation_ratings.rate',
                    'recreation_ratings.comment',
                    'users.name as user',
                    'recreation_ratings.created_at'
                )
                ->where('recreation_ratings.recreation_id', $id)
                ->get();

            $result = [
                'id' => $recreation->id,
                'name' => $recreation->name,
                'city' => $recreation->city,
                'address' => $recreation->address,
                'min_price' => $recreation->min_price,
                'average_rating' => $recreation->average_rating,
                'total_ratings' => $recreation->total_ratings,
                'packages' => $packages,
                'reviews' => $reviews,
            ];

            return ResponseFormatter::success($result, 'Recreation data successfully loaded');
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Failed to load recreation data', 500);
        }
    }
}

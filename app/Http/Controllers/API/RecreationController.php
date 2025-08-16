<?php

namespace App\Http\Controllers\API;

use App\Actions\Recretion\CreateTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ResponseFormatter;
use App\Http\Resources\Recretion\RecretionSearchResource;
use App\Models\CategoryRecreation;
use App\Models\City;
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
use Illuminate\Support\Facades\Storage;
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
            'comment' => 'required',
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
            'comment'       => $request->comment,
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

        $payoutsXendit = app(CreateTransaction::class)->execute($data, $request->user());

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function search(Request $request)
    {
        $find = $request->all();

        $data = Recreation::with('kota', 'recreationPackages', 'reviews')
            ->whereHas('recreationPackages')
            ->when($find['location'], function ($q) use ($find) {
                $q->whereHas('kota', function ($k) use ($find) {
                    $k->where('city_name', 'like', '%' . $find['location'] . '%');
                });
            })->when($find['name'], function ($q) use ($find) {
                $q->where('business_name', 'like', '%' . $find['name'] . '%');
            })
            ->get();


        return ResponseFormatter::success(RecretionSearchResource::collection($data), 'Data successfully loaded');
    }

    public function recreation_by_category(Request $request, $id)
    {
        // Get recreations by category with optional city filter
        $recreations = Recreation::active()
            ->with('reviews', 'recreationPackages', 'kota', 'image')
            ->where('category_recreation_id', $id)
            ->when($request->filled('city'), function ($q) use ($request) {
                $q->whereHas('kota', function ($k) use ($request) {
                    $k->where('city_name', 'like', '%' . $request->city . '%');
                });
            })
            ->get();

        $recre = [];

        foreach ($recreations as $rec) {
            if (count($rec['recreationPackages']) > 0) {
                $img = $rec['image']['image'] ?? null;

                if ($img) {
                    $img = asset('storage/' . $rec['image']['image']);
                } else {
                    $img = asset('images/not_found.jpg');
                }

                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['business_name'],
                    'image' => $img,
                    'location' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'price' => $rec['recreationPackages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                    'avg_rating' => $rec->avgRating(),
                ];

                array_push($recre, $item);
            }
        }

        return ResponseFormatter::success($recre, 'Data successfully loaded');
    }

    public function detail_recreations($id)
    {
        $recreation = Recreation::
            // select('id', 'category_recreation_id', 'business_name', 'description', 'open', 'close', 'lat', 'ltd')
            with([
                // 'recreationPackages' => function ($query) {
                //     $query->select('id', 'recreation_id', 'name', 'description', 'price');
                // },
                'recreationPackages.images',
                'reviews' => function ($query) {
                    $query->select('id', 'recreation_id', 'users_id', 'rate', 'comment')
                        ->with(['user' => function ($query) {
                            $query->select('id', 'name', 'image');
                        }]);
                }
            ])
            ->findOrFail($id);

        $images = $recreation->recreationPackages
            ->flatMap(function ($package) {
                return $package->images->pluck('image');
            })->values();

        $recreation['category'] = $recreation->categoryRecreation->name;
        $recreation['city'] = City::where('city_id', $recreation->city)->value('city_name');
        $recreation['avg_rating'] = $recreation->avgRating();
        $recreation['image'] = $images;

        // $recreation = collect($recreation)->except(['category_recreation']);

        $packages = [];

        foreach ($recreation->recreationPackages as $package) {
            $item = [
                'id' => $package->id,
                'name' => $package->name,
                'name' => $package->name,
                'price' => $package->price,
            ];

            array_push($packages, $item);
        }

        $data = [
            'recreation_id' => $recreation->id,
            'service' => 'recreation',
            'category' => $recreation->categoryRecreation->name ?? '',
            'user' => $recreation->user->name ?? '',
            'name' => $recreation->business_name ?? '',
            'description' => $recreation->description ?? '',
            'buka' => $recreation->open ?? '',
            'tutup' => $recreation->close ?? '',
            'city' => City::where('city_id', $recreation->city)->value('city_name') ?? '',
            'address' => $recreation->address ?? '',
            'latitude' => $recreation->lat ?? 0,
            'longitude' => $recreation->ltd ?? 0,
            'avg_rating' => $recreation->avgRating() ?? 0,
            'rating_count' => $recreation->reviews->count() ?? 0,
            'images' => $images ?? [],
            'packages' => $packages ?? [],
            'comments' => $recreation->reviews ?? [],
        ];
        return ResponseFormatter::success($data, 'Data successfully loaded');

        // if ($recreation) {
        //     $images = $recreation['images'];
        //     $newImages = [];
        //     foreach ($images as $key => $value) {
        //         $img = asset('storage/' . $value['image']);
        //         array_push($newImages, $img);
        //     }
        //     $item = [
        //         'recreation_id' => $recreation['id'],
        //         'service' => 'recreation',
        //         'category' => $recreation['category']['name'] ?? 'invalid category',
        //         'user' => $recreation['user']['name'] ?? 'invalid user',
        //         'name' => $recreation['business_name'],
        //         'description' => $recreation['description'],
        //         'buka' => $recreation['open'],
        //         'tutup' => $recreation['close'],
        //         'city' => $recreation['kota']['city_name'] ?? 'Kota dihapus',
        //         'address' => $recreation['address'],
        //         'latitude' => $recreation['lat'],
        //         'longitude' => $recreation['ltd'],
        //         'rating_count' => count($recreation['reviews']),
        //         'avg_rating' => $recreation->avgRating(),
        //         'images' => $newImages,
        //         'packages' => $recreation['recreationPackages'],
        //         'comments' => $recreation['reviews']
        //     ];

        //     return ResponseFormatter::success($item, 'Data successfully loaded');
        // } else {
        //     return ResponseFormatter::error([], 'Recreation not found');
        // }
    }

    public function booking($id)
    {
        $packages = RecreationPackages::select('id', 'name', 'description', 'price')->findOrFail($id);
        return ResponseFormatter::success($packages, 'Data successfully loaded');
    }

    // new list
    public function list2()
    {
        $recreations = Recreation::active()->with('reviews', 'recreationPackages', 'kota')->get();


        $recre = [];

        foreach ($recreations as $key => $rec) {
            if (count($rec['recreationPackages']) > 0) {
                if (!$rec['image']) {
                    $img = asset('storage/not_found.png');
                } else {
                    $img = asset('storage/' . $rec['image']['image']);
                }

                $item = [
                    'id' => $rec['id'],
                    'name' => $rec['business_name'],
                    'image' => $img,
                    'location' => $rec['kota'] ? $rec['kota']['city_name'] : 'Kota dihapus',
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

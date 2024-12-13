<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewCarRentController extends Controller
{

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

    public function show(Request $request)
    {
        // $providers = [
        //     [
        //         'img' => '',
        //         'name' => 'Honda Mobilio',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'Toyota New Avanza',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'All New Avanza 2022',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'Toyota Innova Reborn',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'Honda Mobilio',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'Toyota New Avanza',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'All New Avanza 2022',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],[
        //         'img' => '',
        //         'name' => 'Toyota Innova Reborn',
        //         'lugage' => '2',
        //         'passage' => '6'
        //     ],
        // ];
        // $providers = json_decode(json_encode($providers));
        $category = $request->category;
        $location = $request->location;
        $date = $request->date;
        $time = $request->time;
        $duration = $request->duration;
        $model = $request->model_id;
        $car_model = $request->car_model_id;

        // if ($request->location) {
        //     $city = City::with(['has_cars' => function ($query) {
        //             $query->with(['brand', 'carRental', 'carRentalRate']);
        //         }])
        //         ->where('city_name', 'like', '%' . $request->location . '%')
        //         ->first();
        // } else {
        //     $city = json_decode(json_encode($city = [
        //         'city_id' => '',
        //     ]));
        // }

        // $cars = CarRentalHasCars::filter(request(['model_id'], $city->city_id))->with(['brand', 'carRental'])
        // ->when($car_model, function($q, $m){
        //     $q->where('car_model_id', $m);
        // })
        // ->get();

        $cars = CarRentalHasCars::with('brand', 'carModel', 'booked', 'carRental')
            ->when($location, function($q, $l){
                $q->whereHas('carRental', function($r)use($l){
                    $r->whereHas('kota', function($k)use($l){
                        $k->where('city_name', 'like', '%'.$l.'%');
                    });
                });
            })
            ->when($category, function($q, $c){
                $q->where('category', 'like', '%'.$c.'%');
            })
            ->when($model, function($q, $m){
                $q->where('car_model_id', $m);
            })
            ->when($car_model, function($q, $m){
                $q->where('car_model_id', $m);
            })
            ->get();
        foreach ($cars as $key => $c) {
            $vendor = CarRentalHasCars::where('brand_id', $c['brand_id'])->get();
            $ven = [];

            foreach ($vendor as $key => $v) {
                $item = [
                    'car_id' => $v['id'],
                    'vendor_id' => $v['car_rental_id'],
                    'business_name' => $v['carRental']['business_name'],
                    'brand_id' => $v['brand_id'],
                    'location' => $v['carRental']['kota']['city_name'],
                    'price' => $v['rental_price_per_day'],
                ];

                array_push($ven, $item);
            }

            $c['vendor'] = $ven;
        }
        $data['cars'] = $cars;
        $data['location'] = $location;
        $data['category'] = $category;
        $data['model'] = $model;
        $data['car_model'] = $car_model;
        $data['date'] = $date;
        $data['time'] = $time;
        $data['duration'] = $duration;
        // $data['providers'] = collect($providers);
        return view('pagesv2.car_rent.show', $data);
    }

    public function detail(Request $request, $category, $lokasi, $model, $provider, $date, $duration)
    {
        $data['car'] = CarRentalHasCars::with(['brand', 'carModel', 'carRental', 'carRentalRate'])->where('id', $provider)->first();
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
            $data['car'] = CarRentalHasCars::with(['brand', 'carRental', 'carModel'])->where('id', $request->car_id)->first();
            $data['duration'] = $request->duration;
            $data['date'] = $request->date;
            $data['category'] = $request->category;
            $data['user'] = $user;
            $data['provider'] = $request->provider;

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

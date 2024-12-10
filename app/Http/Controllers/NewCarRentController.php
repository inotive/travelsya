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
        $car_models = CarModel::with('vendor')->limit(10)->get();

        $dummy_near_location = [
            [
                'id' => 1,
                'img' => '',
                'name' => 'Partner 1',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 2,
                'img' => '',
                'name' => 'Partner 2',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 3,
                'img' => '',
                'name' => 'Partner 3',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 4,
                'img' => '',
                'name' => 'Partner 4',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 5,
                'img' => '',
                'name' => 'Partner 5',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 6,
                'img' => '',
                'name' => 'Partner 6',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 7,
                'img' => '',
                'name' => 'Partner 7',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
            [
                'id' => 8,
                'img' => '',
                'name' => 'Partner 8',
                'lokasi' => 'Jakarta',
                'origin_price' => 300000,
                'cut_price' => 225000,
            ],
        ];
        $dummy_near_location = json_decode(json_encode($dummy_near_location));
        
        $data['car_models'] = collect($car_models);
        $data['near_location'] = collect($dummy_near_location);
        return view('pagesv2.car_rent.index', $data);
    }

    public function show(Request $request){
        
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
        $data['category'] = $request->category ?? '';
        $data['location'] = $request->location ?? '';
        $data['date'] = $request->date ?? '';
        $data['time'] = $request->time ?? '';
        $data['duration'] = $request->duration ?? '';
        $data['model'] = $request->model ?? '';
        $data['model'] = $request->model_id ?? '';

        if($request->location){
            $city = City::
            with(['has_cars' => function($query){$query->with(['brand', 'carRental', 'carRentalRate']);}])
            ->where('city_name', 'like', '%'.$request->location.'%')
            ->first();
        }else{
            $city = json_decode(json_encode($city = [
                'city_id' => '',
            ]));
        }

        $cars = CarRentalHasCars::filter(request(['model_id'], $city->city_id))->with(['brand', 'carRental'])->get();
        $data['cars'] = $cars;
        // $data['providers'] = collect($providers);
        return view('pagesv2.car_rent.show', $data);
    }

    public function detail(Request $request, $lokasi, $model, $provider, $duration){
        $data['model'] = $model;
        $data['provider'] = $provider;
        $data['duration'] = $duration;
        return view('pagesv2.car_rent.detail', $data);
    }

    public function order(Request $request){
        $user = Auth::user();
        if($user){
            $data['car'] = CarRentalHasCars::with(['brand', 'carRental', 'carModel'])->where('id', $request->car_id)->first();
            $data['duration'] = $request->duration;
            $data['date'] = $request->date;
            $data['category'] = $request->category;
            $data['user'] = $user;
            $data['provider'] = $request->provider;

            return view('pagesv2.car_rent.order', $data);
        }else{
            return redirect()->route('login');
        }
        // $data['paket'] = [];
        // return view('pagesv2.car_rent.order', $data);
    }

    public function getVendorCars($brand_id, $city_id){
        if(!is_numeric($brand_id)){
            return response()->json(['error' => 'Invalid ID Brand']);
        }

        if(!is_numeric($city_id)){
            return response()->json(['error' => 'Invalid ID City']);
        }

        $car_vendors = CarRentalHasCars::with('carRental')->where('brand_id', $brand_id)->get();

        return response()->json(['data' => $car_vendors]);
    }
}

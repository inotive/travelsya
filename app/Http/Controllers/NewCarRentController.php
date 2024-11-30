<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewCarRentController extends Controller
{
    
    public function index()
    {
        $dummy_special_deals = [
            [
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 1',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 2',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 3',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 4',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 5',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 6',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 7',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 8',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],
        ];
        $dummy_special_deals = json_decode(json_encode($dummy_special_deals));

        $dummy_favorites_car = [
            [
                'img' => '',
                'name' => 'Honda Mobilio',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota New Avanza',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'All New Avanza 2022',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota Innova Reborn',
                'lugage' => '2',
                'passage' => '6'
            ],
        ];
        $dummy_favorites_car = json_decode(json_encode($dummy_favorites_car));

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

        $data['special_deals'] = collect($dummy_special_deals)->chunk(4);
        $data['favorites_car'] = collect($dummy_favorites_car);
        $data['near_location'] = collect($dummy_near_location);
        return view('pagesv2.car_rent.index', $data);
    }

    public function show(Request $request){
        $providers = [
            [
                'img' => '',
                'name' => 'Honda Mobilio',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota New Avanza',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'All New Avanza 2022',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota Innova Reborn',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Honda Mobilio',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota New Avanza',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'All New Avanza 2022',
                'lugage' => '2',
                'passage' => '6'
            ],[
                'img' => '',
                'name' => 'Toyota Innova Reborn',
                'lugage' => '2',
                'passage' => '6'
            ],
        ];
        $providers = json_decode(json_encode($providers));
        $data['providers'] = collect($providers);
        return view('pagesv2.car_rent.show', $data);
    }

    public function detail(Request $request, $lokasi, $provider){
        $data['providers'] = [];
        return view('pagesv2.car_rent.detail', $data);
    }

    public function order(Request $request, $provider){
        $data['paket'] = [];
        return view('pagesv2.car_rent.order', $data);
    }
}

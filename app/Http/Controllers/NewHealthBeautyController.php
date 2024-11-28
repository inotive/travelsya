<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewHealthBeautyController extends Controller
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

        $dummy_categories = [
            [
                'img' => '',
                'name' => 'Perawatan Kulit',
                'slug' => 'perawatan_kulit'
            ],
            [
                'img' => '',
                'name' => 'Perawatan Kuku',
                'slug' => 'perawatan_kuku'
            ],
            [
                'img' => '',
                'name' => 'Perawatan Rambut',
                'slug' => 'perawatan_rambut'
            ],
            [
                'img' => '',
                'name' => 'Makeup',
                'slug' => 'makeup'
            ],
            [
                'img' => '',
                'name' => 'Healthcare',
                'slug' => 'healthcare'
            ],
            [
                'img' => '',
                'name' => 'Makeup',
                'slug' => 'makeup'
            ],
            [
                'img' => '',
                'name' => 'Perawatan Kuku',
                'slug' => 'perawatan_kuku'
            ],
            [
                'img' => '',
                'name' => 'Healthcare',
                'slug' => 'healthcare'
            ],
        ];
        $dummy_categories = json_decode(json_encode($dummy_categories));

        $dummy_partners = [
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
        $dummy_partners = json_decode(json_encode($dummy_partners));

        $data['special_deals'] = collect($dummy_special_deals)->chunk(4);
        $data['categorises'] = collect($dummy_categories)->chunk(4);
        $data['partners'] = collect($dummy_partners)->chunk(4);
        return view('pagesv2.health_beauty.index', $data);
    }

    public function show(Request $request){
        $dummy_clinics = [
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
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 9',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 10',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 11',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 12',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 13',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 14',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 15',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 16',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],
        ];
        $dummy_clinics = json_decode(json_encode($dummy_clinics));
        $data['chunked_clinics'] = collect($dummy_clinics);
        return view('pagesv2.health_beauty.show', $data);
    }

    public function detail(Request $request, $lokasi, $clinic){
        $data['clinics'] = [];
        return view('pagesv2.health_beauty.detail', $data);
    }

    public function order(Request $request, $clinic){
        $data['paket'] = [];
        return view('pagesv2.health_beauty.order', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recreation;
use Illuminate\Http\Request;

class NewRecreationController extends Controller
{
    public function index()
    {
        $specials = Recreation::Active()->with('recreationPackages', 'reviews', 'kota')
            // ->whereHas('recreationPackages', function($p){
            //     $p->whereColumn('unit_price', '>', 'price');
            // })
            ->limit(10)
            ->get();

        $special_deals = [];

        foreach ($specials as $key => $rec) {
            if (count($rec['recreationPackages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                    'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'name' => $rec['clinic_name'],
                    'rate' => $rec->avgRating(),
                    'category' => $rec['category'],
                    // 'origin_price' => (int)$rec['packages'][0]['unit_price'],
                    'origin_price' => $rec['recreationPackages'][0]['unit_price'],
                    'cut_price' => $rec['recreationPackages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                ];

                array_push($special_deals, $item);
            }
        }
        // $dummy_special_deals = [
        //     [
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 1',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 2',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 3',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 4',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 5',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 6',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 7',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],[
        //         'img' => '',
        //         'lokasi' => 'jakarta',
        //         'name' => 'Product 8',
        //         'rate' => '4.8',
        //         'origin_price' => 250000,
        //         'cut_price' => 175000,
        //     ],
        // ];
        // $dummy_special_deals = json_decode(json_encode($dummy_special_deals));

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

        $data['special_deals'] = collect($special_deals);
        $data['categorises'] = collect($dummy_categories);
        $data['partners'] = collect($dummy_partners);
        return view('pagesv2.rekreasi.index', $data);
    }

    public function show(Request $request){
        $clinics = [
            [
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 1',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 2',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 3',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 4',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 5',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 6',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 7',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 8',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 9',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 10',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 11',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 12',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 13',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 14',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 15',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 16',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],
        ];
        $clinics = json_decode(json_encode($clinics));
        $data['clinics'] = collect($clinics)->filter(function($clinic) use ($request){
            return $clinic->lokasi == $request->lokasi;
        });
        return view('pagesv2.rekreasi.show', $data);
    }

    public function detail(Request $request, $lokasi, $clinic){
        $data['clinics'] = [];
        return view('pagesv2.rekreasi.detail', $data);
    }

    public function order(Request $request, $clinic){
        $data['paket'] = [];
        return view('pagesv2.rekreasi.order', $data);
    }
}

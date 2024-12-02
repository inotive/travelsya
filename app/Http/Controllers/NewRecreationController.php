<?php

namespace App\Http\Controllers;

use App\Models\CategoryRecreation;
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

        $categories = CategoryRecreation::select('id', 'name')->get()->toArray();

        $categorises = [];

        if(count($categories) > 0){
            foreach ($categories as $key => $rec) {
                $item = [
                        'id' => $rec['id'],
                        'name' => $rec['name'],
                    ];

                array_push($categorises, $item);
            }
        }

        $data_partners = Recreation::Active()->with('reviews', 'kota')
            ->limit(10)
            ->get();

        $partners = [];

        foreach ($data_partners as $key => $rec) {
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

                array_push($partners, $item);
        }

        $data['special_deals'] = collect($special_deals);
        $data['categorises'] = collect($categorises);
        $data['partners'] = collect($partners);
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

    public function detail(Request $request, $id){
        $data['detail'] = Recreation::with('reviews', 'recreationPackages', 'kota')->find($id);
        return view('pagesv2.rekreasi.detail', $data);
    }

    public function order(Request $request, $clinic){
        $data['paket'] = [];
        return view('pagesv2.rekreasi.order', $data);
    }
}

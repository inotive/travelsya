<?php

namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use Illuminate\Http\Request;

class NewHealthBeautyController extends Controller
{
    public function index()
    {
        $special = Clinic::Active()->with('reviews', 'packages', 'kota')
            ->whereHas('packages', function ($p) {
                $p->whereColumn('unit_price', '>', 'price');
            })
            ->limit(10)
            ->get();

        $special_deals = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                foreach ($rec['packages'] as $key => $value) {
                    $item = [
                        'id' => $rec['id'],
                        'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                        'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'clinic' => $rec['clinic_name'],
                        'name' => $value['name'],
                        'rate' => $rec->avgRating(),
                        'category' => $rec['category'],
                        'origin_price' => (int)$value['unit_price'],
                        'cut_price' => $value['price'],
                        'rating_count' => count($rec['reviews']),
                    ];
                    array_push($special_deals, $item);
                }

            }
        }

        $categories = CategoriesServices::get();

        $partners = Clinic::with('packages')->orderBy('created_at', 'desc')->get();
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
        $data['categorises'] = collect($categories);
        $data['partners'] = collect($partners);

        return view('pagesv2.health_beauty.index', $data);
    }

    public function show_special_deals(){
        $special = Clinic::Active()->with('reviews', 'packages', 'kota')
            ->whereHas('packages', function ($p) {
                $p->whereColumn('unit_price', '>', 'price');
            })
            ->limit(10)
            ->get();

        $special_deals = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                    'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'name' => $rec['clinic_name'],
                    'rate' => $rec->avgRating(),
                    'category' => $rec['category'],
                    'origin_price' => (int)$rec['packages'][0]['unit_price'],
                    'cut_price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                ];

                array_push($special_deals, $item);
            }
        }

        $item = [
            'id' => 4,
            'img' => 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg',
            'lokasi' => 'Kota Dihapus',
            'name' => 'klinik baru A',
            'rate' => 4.75,
            'category' => 'health',
            'origin_price' => 350000,
            'cut_price' => 275000,
            'rating_count' => 189,
        ];

        array_push($special_deals, $item);

        $item = [
            'id' => 5,
            'img' => 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg',
            'lokasi' => 'Kota Dihapus',
            'name' => 'klinik baru B',
            'rate' => 4.85,
            'category' => 'health',
            'origin_price' => 450000,
            'cut_price' => 399000,
            'rating_count' => 2500,
        ];

        array_push($special_deals, $item);

        $special_deals = json_decode(json_encode($special_deals));

        $data['special_deals'] = collect($special_deals);

        return view('pagesv2.health_beauty.show_special_deals', $data);
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
            return $clinic->category == $request->category;
        });
        return view('pagesv2.health_beauty.show', $data);
    }

    public function detail(Request $request, $lokasi, $clinic, $id = null){
        if($id){
            $data['clinic'] = Clinic::find($id);
        }else{
            $data['clinic'] = null;
        }

        return view('pagesv2.health_beauty.detail', $data);
    }

    public function order(Request $request, $clinic){
        $data['paket'] = [];
        return view('pagesv2.health_beauty.order', $data);
    }
}

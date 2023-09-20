<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Services\Travelsya;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function home()
    {
        // $hostelPopulers = $this->travelsya->hostelPopuler();
        // $cities = $this->travelsya->hostelCity();
        // $ads = $this->travelsya->ads();
        // return view('home', ['hostelPopulers' => $hostelPopulers['data'], 'cities' => $cities['data'], 'ads' => $ads['data']]);
        //        dd('haloo');
        $hotels = Hotel::all();



        $dummyHotels = $hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'label' => $hotel->name,
            ];
        })->toArray();

        $data['hotels'] = $dummyHotels;

        $data['listAds'] = DB::table('ads')
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', $data);
    }
}

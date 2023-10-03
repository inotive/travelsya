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
        $hotels = Hotel::with('hotelRoom', 'hotelImage')->latest()->get();
        $dummyHotels = $hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'label' => $hotel->name,
            ];
        })->toArray();

        $hotel_favorite = Hotel::with('hotelRoom', 'hotelImage')
            ->leftJoin('hotel_rooms', 'hotels.id', '=', 'hotel_rooms.hotel_id')
            ->leftJoin('hotel_ratings', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->select('hotels.*', DB::raw('COALESCE(hotel_ratings.rate, 0) as rating'), DB::raw('COALESCE(hotel_rooms.sellingprice, 0) as selling_price'))
            ->orderByDesc('hotel_ratings.rate')
            ->orderBy('hotel_rooms.sellingprice')
            ->limit(4)
            ->get();

        $hotelDetails = [];

        foreach ($hotel_favorite as $favorite) {
            $jumlahTransaksi = $favorite->hotelRating->count();
            $totalRating = $favorite->hotelRating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating = $totalRating / $jumlahTransaksi;
                $resultRating = ($avgRating / 10) * 5;
            } else {
                $avgRating = 0;
                $resultRating = 0;
            }

            $hotelDetails[$favorite->id] = [
                'total_rating' => $totalRating,
                'result_rating' => $resultRating,
                'star_rating' => floor($resultRating),
            ];
        }

        $data['hotels'] = $dummyHotels;
        $data['hotel_favorite'] = $hotel_favorite;
        $data['hotel_detail'] = $hotelDetails;

        $data['listAds'] = DB::table('ads')
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', $data);
    }
}

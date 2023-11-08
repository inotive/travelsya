<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Hostel;
use App\Services\Travelsya;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function home()
    {
        $hotels = Hotel::with('hotelRoom', 'hotelImage')->latest()->get();
        $dummyHotels = $hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'label' => $hotel->name,
            ];
        })->toArray();

        $hotel_favorite = Hotel::with('hotelRoom', 'hotelImage')
            ->select('hotels.id', 'hotels.name', 'hotels.user_id')
            ->selectSub(function ($query) {
                $query->selectRaw('COALESCE(MAX(rate), 0)')
                    ->from('hotel_ratings')
                    ->whereColumn('hotels.id', 'hotel_ratings.hotel_id');
            }, 'rating')
            ->selectSub(function ($query) {
                $query->selectRaw('COALESCE(MIN(sellingprice), 0)')
                    ->from('hotel_rooms')
                    ->whereColumn('hotels.id', 'hotel_rooms.hotel_id');
            }, 'selling_price')
            ->groupBy('hotels.id', 'hotels.name', 'hotels.user_id')
            ->orderByDesc('rating')
            ->orderBy('selling_price')
            ->take(8)
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

        $hostel_favorite = Hostel::with('hostelRoom', 'hostelImage', 'rating', 'hostelFacilities')
            ->withCount([
                "hostelRoom as price_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(sellingrentprice_monthly),0)'));
                }
            ])
            ->withCount([
                "rating as rating_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(rate),0)'));
                }
            ])
            ->withCount("rating as rating_count")
            ->leftJoin('hostel_rooms', 'hostels.id', '=', 'hostel_rooms.hostel_id')
            ->leftJoin('hostel_ratings', 'hostels.id', '=', 'hostel_ratings.hostel_id')
            ->orderByDesc('hostel_ratings.rate')
            ->orderBy('hostel_rooms.sellingrentprice_monthly')
            ->limit(4)
            ->get();

        $data['hotels'] = $dummyHotels;
        $data['hotel_favorite'] = $hotel_favorite;
        $data['hotel_detail'] = $hotelDetails;
        $data['hostel_favorite'] = $hostel_favorite;

        $data['ewallets'] = Product::where('is_active', 1)
            ->where('service_id', 11)
            ->distinct('name')
            ->pluck('name');

        $data['listAds'] = DB::table('ads')
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->get();

        $data['hotelByCity'] = DB::table('cities')->where('status', 1)
            ->orderBy('city_name', 'asc')
            ->get();

        return view('home', $data);
    }
}

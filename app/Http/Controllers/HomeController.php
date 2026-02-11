<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Hostel;
use App\Models\City;
use App\Services\Travelsya;
use App\Http\Controllers\Controller;
use App\Models\CategoryRecreation;
use App\Models\Recreation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function home()
    {
        Log::info('Home page loaded');

        try {
            Log::info('Fetching active hotels');
            $hotels = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelImage')->latest()->get();
            $dummyHotels = $hotels->map(function ($hotel) {
                Log::debug('Processing hotel', ['id' => $hotel->id, 'name' => $hotel->name]);
                return [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'label' => $hotel->name,
                ];
            })->toArray();

            Log::info('Fetching favorite hotels');
            $hotel_favorite = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelImage')
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

            Log::info('Processing hotel details');
            $hotelDetails = [];

            foreach ($hotel_favorite as $favorite) {
                // Use array access syntax for safety
                $favoriteId = isset($favorite->id) ? $favorite->id : 'unknown';
                $favoriteName = isset($favorite->name) ? $favorite->name : 'unknown';
                Log::debug('Processing hotel detail', ['id' => $favoriteId, 'name' => $favoriteName]);
                // Check if hotelRating relationship exists and is accessible
                $jumlahTransaksi = 0;
                $totalRating = 0;

                // Safe access to hotelRating relationship
                if (is_object($favorite) && method_exists($favorite, 'hotelRating') && $favorite->hotelRating) {
                    $jumlahTransaksi = $favorite->hotelRating->count();
                    $totalRating = $favorite->hotelRating->sum('rate');
                } elseif (isset($favorite['hotelRating']) && is_array($favorite['hotelRating'])) {
                    $jumlahTransaksi = count($favorite['hotelRating']);
                    $totalRating = array_sum(array_column($favorite['hotelRating'], 'rate'));
                }

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

            Log::info('Fetching favorite hostels');
            $hostel_favorite = Hostel::where('hostels.is_active', '=', 1)->with('hostelRoom', 'hostelImage', 'rating', 'hostelFacilities')
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

            Log::info('Home page data prepared successfully');
        } catch (\Exception $e) {
            Log::error('Error loading home page', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }

        try {
            Log::info('Fetching ewallet products');
            $data['ewallets'] = Product::where('is_active', 1)
                ->where('category', 'ewallet')
                ->where('service_id', 11)
                ->distinct('name')
                ->pluck('name');

            Log::info('Fetching ads');
            $data['listAds'] = DB::table('ads')
                ->where('is_active', 1)
                ->where('deleted_at', null)
                ->orderBy('created_at', 'desc')
                ->get();

            Log::info(message: 'Fetching hotels by city');
            $data['hotelByCity'] = DB::table('cities')->where('status', 1)
                ->orderBy('city_name', 'asc')
                ->get();
            // dd($data['hotelByCity']);

            Log::info('Fetching all cities');
            $data['cities'] = City::all();

            Log::info('Fetching recreation cities');
            $data['recreation_city'] = City::whereHas('recreations')->get();

            Log::info('Fetching recreation categories');
            $data['category_recreation'] = CategoryRecreation::get();

            Log::info('All home page data prepared successfully');
        } catch (\Exception $e) {
            Log::error('Error loading additional home page data', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }

        return view('home', $data);
    }
}

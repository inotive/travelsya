<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\HotelRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // public function index(Request $request)
    // {


    //     $user_id = auth()->user()->id;

    //     $query = DB::table('hotel_ratings')
    //         ->join('users', 'users.id', '=', 'hotel_ratings.users_id')
    //         ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
    //         ->join('transactions', 'transactions.id', '=', 'hotel_ratings.transaction_id')
    //         ->where('hotels.user_id', $user_id);


    //     if ($request->has('rate')) {
    //         $query->where('hotel_ratings.rate', $request->rate);
    //     }

    //     $ratings = $query->select('hotel_ratings.*', 'hotel_ratings.created_at as createdat', 'users.name as user_name', 'hotels.*', 'transactions.id as transaction_id')->get();

    //     $avg_rate = DB::table('hotel_ratings')
    //         ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
    //         ->where('hotels.user_id', $user_id)
    //         ->avg('rate');

    //     $total_review = DB::table('hotel_ratings')
    //         ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
    //         ->where('hotels.user_id', $user_id)
    //         ->count();

    //     $ratingCounts = [
    //         '5' => $query->where('rate', 5)->count(),
    //         '4' => $query->where('rate', 4)->count(),
    //         '3' => $query->where('rate', 3)->count(),
    //         '2' => $query->where('rate', 2)->count(),
    //         '1' => $query->where('rate', 1)->count(),
    //     ];



    //     return view('ekstranet.review.index', compact('ratings', 'avg_rate', 'total_review', 'ratingCounts'));
    // }
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        $review_hotel = DB::table('hotel_ratings')
            ->join('users', 'users.id', '=', 'hotel_ratings.user_id')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->join('transactions', 'transactions.id', '=', 'hotel_ratings.transaction_id')
            ->where('hotels.user_id', $user_id)->select('hotel_ratings.*', 'hotel_ratings.created_at as createdat', 'users.name as user_name', 'hotels.*', 'transactions.id as transaction_id')
            ->get();

        $review_hostel = DB::table('hostel_ratings')
            ->join('users', 'users.id', '=', 'hostel_ratings.users_id')
            ->join('hostels', 'hostels.id', '=', 'hostel_ratings.hostel_id')
            ->join('transactions', 'transactions.id', '=', 'hostel_ratings.transaction_id')
            ->where('hostels.user_id', $user_id)->select('hostel_ratings.*', 'hostel_ratings.created_at as createdat', 'users.name as user_name', 'hostels.*', 'transactions.id as transaction_id')
            ->get();

        $review_hotel_collection = collect($review_hotel);
        $review_hostel_collection = collect($review_hostel);

        $data['ratings'] = $review_hotel_collection->merge($review_hostel_collection);
        $data['ratings_5'] = $data['ratings']->filter(function ($item) {
            return $item->rate == 5;
        });

        $data['ratings_4'] = $data['ratings']->filter(function ($item) {
            return $item->rate == 4;
        });

        $data['ratings_3'] = $data['ratings']->filter(function ($item) {
            return $item->rate == 3;
        });

        $data['ratings_2'] = $data['ratings']->filter(function ($item) {
            return $item->rate == 2;
        });

        $data['ratings_1'] = $data['ratings']->filter(function ($item) {
            return $item->rate == 1;
        });

        $hotel_avg_rate = DB::table('hotel_ratings')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->where('hotel_ratings.transaction_id', '!=', '0')
            ->where('hotels.user_id', $user_id)
            ->avg('rate');

        $hostel_avg_rate = DB::table('hostel_ratings')
            ->join('hostels', 'hostels.id', '=', 'hostel_ratings.hostel_id')
            ->where('hostel_ratings.transaction_id', '!=', '0')
            ->where('hostels.user_id', $user_id)
            ->avg('rate');

        $data['avg_rate'] = ($hotel_avg_rate + $hostel_avg_rate) / 2;

        $total_hotel_review = DB::table('hotel_ratings')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->where('hotel_ratings.transaction_id', '!=', '0')
            ->where('hotels.user_id', $user_id)
            ->count();

        $total_hostel_review = DB::table('hostel_ratings')
            ->join('hostels', 'hostels.id', '=', 'hostel_ratings.hostel_id')
            ->where('hostel_ratings.transaction_id', '!=', '0')
            ->where('hostels.user_id', $user_id)
            ->count();

        $data['total_review'] = $total_hotel_review + $total_hostel_review;

        return view('ekstranet.review.index', compact('data'));
    }
}

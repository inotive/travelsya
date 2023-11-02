<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\HotelRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {


        $user_id = auth()->user()->id;

        $query = DB::table('hotel_ratings')
            ->join('users', 'users.id', '=', 'hotel_ratings.user_id')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->join('transactions', 'transactions.id', '=', 'hotel_ratings.transaction_id')
            ->where('hotels.user_id', $user_id);


        if ($request->has('rate')) {
            $query->where('hotel_ratings.rate', $request->rate);
        }

        $ratings = $query->select('hotel_ratings.*', 'hotel_ratings.created_at as createdat', 'users.name as user_name', 'hotels.*', 'transactions.id as transaction_id')->get();

        $avg_rate = DB::table('hotel_ratings')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->where('hotels.user_id', $user_id)
            ->avg('rate');

        $total_review = DB::table('hotel_ratings')
            ->join('hotels', 'hotels.id', '=', 'hotel_ratings.hotel_id')
            ->where('hotels.user_id', $user_id)
            ->count();

        $ratingCounts = [
            '5' => $query->where('rate', 5)->count(),
            '4' => $query->where('rate', 4)->count(),
            '3' => $query->where('rate', 3)->count(),
            '2' => $query->where('rate', 2)->count(),
            '1' => $query->where('rate', 1)->count(),
        ];



        return view('ekstranet.review.index', compact('ratings', 'avg_rate', 'total_review', 'ratingCounts'));
    }
}

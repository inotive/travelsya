<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\HotelRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingHotelController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hotel_id"      => "required",
            "hotel_room_id" => "required",
            "transaction_id" => "required",
            "review"        => "required",
            "bintang"       => "required",
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['response' => $validator->errors()], 'Review Hotel Gagal Dikirim', 500);
        }

        HotelRating::create([
            'hotel_id'      => $request->hotel_id,
            'hotel_room_id' => $request->hotel_room_id,
            'transaction_id' => $request->transaction_id,
            'users_id'      => auth()->id(),
            'rate'          => $request->bintang,
            'comment'       => $request->review,
        ]);

        return ResponseFormatter::success([], 'Review Hotel Telah Berhasil Dikirim');
    }
}

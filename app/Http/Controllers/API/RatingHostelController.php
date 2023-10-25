<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\HostelRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingHostelController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hostel_id"      => "required",
            "hostel_room_id" => "required",
            "review"        => "required",
            "bintang"       => "required",
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['response' => $validator->errors()], 'Review Hostel Gagal Dikirim', 500);
        }

        HostelRating::create([
            'hostel_id'      => $request->hostel_id,
            'hostel_room_id' => $request->hostel_room_id,
            'users_id'      => auth()->id(),
            'rate'          => $request->bintang,
            'comment'       => $request->review,
        ]);

        return ResponseFormatter::success([], 'Review Hostel Telah Berhasil Dikirim');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // public function getPoint()
    // {
    //     try {
    //         $point = Setting::where('category', 'point')->first();

    //         return ResponseFormatter::success($point, 'Data successfully loaded');
    //     } catch (\Throwable $th) {
    //         return ResponseFormatter::error([
    //             $th,
    //             'message' => 'Something wrong',
    //         ], 'Fetch data failed', 500);
    //     }
    // }
}

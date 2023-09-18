<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PulsaDataController extends Controller
{
    public function getPulsa()
    {
        $products = Product::where([
            ['category', 'pulsa'],
            ['is_active', 1],
        ])->get();

        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }

    public function getData()
    {
        $products = Product::where([
            ['category', 'data'],
            ['is_active', 1],
        ])->get();

        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EwalletController extends Controller
{
    public function products($jenis)
    {
        $products = Product::where('name', 'like', '%' . $jenis . '%')
            ->where('is_active', 1)
            ->get();

        $products = $products->map(function ($product) {
            return [
                "id" => $product->id,
                "category" => $product->category,
                "service_id" => $product->service_id,
                "kode" => $product->kode,
                "name" => $product->name,
                "price" => $product->price
            ];
        });

        return response()->json($products);
    }
}

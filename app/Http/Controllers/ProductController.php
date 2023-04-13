<?php

namespace App\Http\Controllers;

use App\Services\Travelsya;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }
    public function pulsa()
    {
        return view('product.pulsa');
    }

    public function ajaxPpob(Request $request)
    {
        try {
            $data = $request->all();


            if ($data['operator'] == 3)
                $data['operator'] = "three";

            $pricelist = $this->travelsya->pricelist();


            if ($pricelist['meta']['code'] != 200)
                return response()->json(['message' => 'not found']);

            $category = array_filter($pricelist['data'], function ($var) use ($data) {
                return ($var['category'] == $data['category']);
            });

            $pulsa = array_filter($category, function ($var) use ($data) {
                // return ($var['name'] == $data['operator']);
                return (str_contains($var['name'], strtoupper($data['operator'])));
            });

            return response()->json($pulsa);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'not found']);
        }
    }
}

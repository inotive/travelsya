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

    public function data()
    {
        return view('product.data');
    }

    public function bpjs()
    {
        return view('product.bpjs');
    }

    public function pdam()
    {
        return view('product.pdam');
    }

    public function pln()
    {
        return view('product.pln');
    }

    public function tvInternet()
    {
        return view('product.tv');
    }

    public function show($product)
    {

        return view('product.detail-product');
    }

    public function ajaxPpob(Request $request)
    {
        try {
            $data = $request->all();


            if ($data['operator'] == 3)
                $data['operator'] = "three";

            if ($data['operator'] == "Indosat Ooredoo")
                $data['operator'] = "indosat";

            if ($data['operator'] == "XL Axiata")
                $data['operator'] = "xl";


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
            return response()->json($pricelist);
        }
    }
}

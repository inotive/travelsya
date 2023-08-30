<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Mymili;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Travelsya;
use App\Services\Xendit;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $travelsya, $xendit, $mymili;

    public function __construct(Travelsya $travelsya, Xendit $xendit, Mymili $mymili)
    {
        $this->travelsya = $travelsya;
        $this->xendit = $xendit;
        $this->mymili = $mymili;
    }

    public function pulsa()
    {
        return view('product.pulsa');
    }

    public function pulsaData($category, $provider)
    {
        $data = Product::where([
            ['category', '=', $category],
            ['name', 'like', '%' . strtoupper($provider) . '%'],
            ['is_active', '=', 1],
        ])->get();

        return response()->json($data);
    }

    public function paymentPulsaData(Request $request)
    {
        $data = $request->all();
        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['product']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $amount = $setting->getAmount($product->price, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => $product->description,
                    "price" => $product->price,
                    "quantity" => 1,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url'  => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: "somenumber",
            ],
            'fees' => $fees
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'PULSA-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount
        ]);

        return redirect($payoutsXendit['invoice_url']);
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

    public function pln(Request $request)
    {
        // return view('product.pln');


        $data = $request->all();

        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $data['no_pelanggan'],
            'nom' => $data['nom'],
        ]);

        // if (str_contains($requestMymili['status'], "SUKSES")) {
        //     return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        // } else {
        //     return ResponseFormatter::error($requestMymili, 'Inquiry failed');
        // }
    }

    public function paymentPln(Request $request)
    {
        $data = $request->all();
        dd($data);
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

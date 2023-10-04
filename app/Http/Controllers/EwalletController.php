<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Travelsya;
use App\Services\Xendit;
use Illuminate\Http\Request;

class EwalletController extends Controller
{

    protected $travelsya, $xendit, $mymili;

    public function __construct(Travelsya $travelsya, Xendit $xendit)
    {
        $this->travelsya = $travelsya;
        $this->xendit = $xendit;
    }

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

    public function payment(Request $request)
    {
        $data = $request->all();
        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['produk_ewallet']);
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

        DetailTransaction::create([
            'transaction_id' => $storeTransaction->id,
            'product_id' => $product->id,
            'price' => $amount,
            'qty' => 1,
            'no_hp' => $data['notelp'],
            'status' => "PROCESS"
        ]);

        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

        return redirect($payoutsXendit['invoice_url']);
    }
}

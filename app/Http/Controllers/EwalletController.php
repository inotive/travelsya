<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\DetailTransaction;
use App\Models\DetailTransactionTopUp;
use App\Models\Fee;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Travelsya;
use App\Services\Xendit;
use Carbon\Carbon;
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

        $fee = Fee::where('service_id', $product->service_id)->first();
        $uniqueCode = rand(111, 999);

        $fees = [
            [
                'type' => 'admin',
                'value' => $fee->percent == 0 ? $fee->value :  $product->price * $fee->value / 100,
            ],
            [
                'type' => 'Kode Unique',
                'value' => $uniqueCode,
            ],
        ];

        $pointDigunakan = 0;
        if ( $request->point !== null) {
            $pointDigunakan = $request->point * 10 / 100;

            array_push($fees, [
                'type' => 'point',
                'value' => 0 - $pointDigunakan,
            ]);
        }

        $sellingPrice = $request->point !== null ? $product->price - abs($pointDigunakan) : $product->price;
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;

        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => $product->description,
                    "price" => $sellingPriceFinal,
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

        $helper = new General();

        DetailTransactionTopUp::create([
            'transaction_id' => $storeTransaction->id,
            'product_id'     => $product->id,
            'nomor_telfon'   => $data['notelp'],
            'total_tagihan'  => $amount,
            'fee_travelsya'  => $fees[0]['value'],
            'fee_mili'       => 0,
            'message'        => 'Top UP sedang diproses',
            'status'         => "PROCESS",
            "kode_unik"      => $uniqueCode,
            "created_at" => Carbon::now()
        ]);


        //deductpoint
        if ($request->point !== null) {
            //deductpoint
            $point = new Point();
            $point->deductPoint($request->user()->id, abs($pointDigunakan), $storeTransaction->id);
        }
        return redirect($payoutsXendit['invoice_url']);
    }
}

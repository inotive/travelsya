<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Mymili as ServicesMymili;
use App\Services\Point;
use App\Services\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\Xendit;
class PulsaDataController extends Controller
{
    protected $mymili, $xendit;
    public function __construct(ServicesMymili $mymili, Xendit $xendit)
    {
        $this->mymili = $mymili;
        $this->xendit = $xendit;
    }

    public function getPulsa(Request $request)
    {
        $products = Product::where([
            ['category', '=', 'pulsa'],
            ['name', 'like', '%' . strtoupper($request->provider) . '%'],
            ['is_active', '=', 1],
        ])->get();

        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }

    public function getData(Request $request)
    {
        $products = Product::where([
            ['category', 'data'],
            ['name', 'like', '%' . strtoupper($request->provider) . '%'],
            ['is_active', 1],
        ])->get();

        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }
    public function pembayaranPulsa(Request $request)
    {
        $data = $request->all();

        // handle validation
        $validator = Validator::make($request->all(), [
            'service' => 'required',
            'product_id' => 'required',
            'no_hp' => 'required',
            'kode_pembayaran' => 'required',
        ]);

//            if ($validator->fails()) {
//                return ResponseFormatter::error([
//                    'response' => $validator->errors(),
//                ], 'Transaction failed', 500);
//            }

        //get data
        $data['user_id'] = 2;
        $product = Product::with('service')->find($data['product_id']);
        $data['no_inv'] = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $price = $product->price;

        $setting = new Setting();
        $fees = $setting->getFees(1, $product->service_id, 2, $price);

        if (!$fees) {
            return ResponseFormatter::error(null, 'Point invalid');
        }
        //$amount = $setting->getAmount($price, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $data['no_inv'],
            'items' => [
                [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $price,
                    'url' => "someurl"
                ]
            ],
            'amount' => $price,
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: "somenumber",
            ],
            'fees' => $fees
        ]);

        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');

        if (isset($payoutsXendit['status'])) {

            $data['status'] = $payoutsXendit['status'];
            $data['link'] = $payoutsXendit['invoice_url'];

            // create transaction
            // unset($data['detail']);
            // unset($data['fees']);
            // unset($data['inquiry']);
            // unset($data['point']);
            $transaction = Transaction::create([
                'no_inv' => $data['no_inv'],
                'service' => $product->service->name,
                'service_id' => $product->service_id,
                'payment' => $data['payment'],
                'user_id' => 2,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $price
            ]);

            // create detail transaction
            $data['detail'] = $request->input('detail');
            DB::table('detail_transaction_top_up')->insert([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'nomor_telfon' => $data['no_hp'],
                'total_tagihan' => $price,
                'fee_travelsya' => 2500,
                'fee_mili' => 2500,
                'message' => 'Pulsa sedang diproses',
                'status' => "PROCESS"
            ]);
//            DetailTransaction::create([
//                'transaction_id' => $transaction->id,
//                'product_id' => $product['id'],
//                'price' => $price,
//                'qty' => $data['detail'][0]['qty'],
//                'no_hp' => $data['detail'][0]['no_hp'],
//                'status' => "PROCESS"
//            ]);

//            if ($data['point']) {
//                //deductpoint
//                $point = new Point;
//                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $transaction->id);
//            }

//            DB::transaction(function () use ($data, $product, $request, $amount, $fees, $payoutsXendit) {
//                //create transaction
//
//            });

            return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
        }


        // response with link
//
//        try {
//
//        } catch (\Throwable $th) {
//            return ResponseFormatter::error([
//                $th,
//                'message' => $th,
//            ], 'Transaction failed', 500);
//        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Mymili as ServicesMymili;
use App\Services\Xendit;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use App\Models\DetailTransaction;
use App\Services\Point;
use App\Services\Setting;
use Illuminate\Support\Facades\DB;

class PpobController extends Controller
{
    protected $mymili, $xendit;
    public function __construct(ServicesMymili $mymili, Xendit $xendit)
    {
        $this->mymili = $mymili;
        $this->xendit = $xendit;
    }

    public function getService($id)
    {
        $ppob = Product::where('id', $id)
            ->where('is_active', 1)
            ->get();

        if (count($ppob)) {
            return ResponseFormatter::success($ppob, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }

    public function getServices()
    {
        $ppob = Product::where('is_active', 1)->get();

        if (count($ppob)) {
            return ResponseFormatter::success($ppob, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }

    public function transaction(Request $request)
    {
        $data = $request->all();

        $transaction = $this->mymili->transaction($data);
        if ($transaction['RESPONSECODE'] == 00) {
            return ResponseFormatter::success($transaction, 'Transaction request success');
        } else {
            return ResponseFormatter::error(null, $transaction['MESSAGE']);
        }
    }

    public function status(Request $request)
    {
        $data = $request->all();

        $transaction = $this->mymili->status($data);
        if ($transaction['RESPONSECODE'] == 00) {
            return ResponseFormatter::success($transaction, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, $transaction['MESSAGE']);
        }
    }


    public function requestTransaction(Request $request)
    {
        try {
            $data = $request->all();

            // handle validation
            $validator = Validator::make($request->all(), [
                'service' => 'required',
                'payment' => 'required',
                'inquiry' => 'required',
                'detail.*.product_id' => 'required',
                'detail.*.no_hp' => 'required',
                'detail.*.name' => 'required',
                'detail.*.qty' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Transaction failed', 500);
            }

            //get data
            $data['user_id'] = $request->user()->id;
            $product = Product::with('service')->find($data['detail'][0]['product_id']);
            $data['no_inv'] = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();

            if ($data['inquiry'] == 1) {
                $inquiry = $this->mymili->inquiry([
                    'no_hp' => $data['detail'][0]['no_hp'],
                    'nom' => $data['detail'][0]['name_cek']
                ]);
                if (isset($inquiry['tagihan'])) {
                    $price = $inquiry['tagihan'];
                } else {
                    return ResponseFormatter::error($inquiry, 'Inquiry invalid');
                }
            } else {
                $price = $product->price;
            }
            $setting = new Setting();
            $fees = $setting->getFees($data['point'], $product->service_id, $request->user()->id, $price);
            if (!$fees) return ResponseFormatter::error(null, 'Point invalid');
            $amount = $setting->getAmount($price, $data['detail'][0]['qty'], $fees);


            //request xendit
            $payoutsXendit = $this->xendit->create([
                'external_id' => $data['no_inv'],
                'items' => [[
                    'name' => $product['name'],
                    'quantity' => $data['detail'][0]['qty'],
                    'price' => $price,
                    'url' => $data['detail'][0]['url'] ?: "someurl"
                ]],
                'amount' => $amount,
                'success_redirect_url'  => route('redirect.succes'),
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

            if (isset($payoutsXendit['status'])) {

                $data['status'] = $payoutsXendit['status'];
                $data['link'] = $payoutsXendit['invoice_url'];

                // create transaction
                // unset($data['detail']);
                // unset($data['fees']);
                // unset($data['inquiry']);
                // unset($data['point']);
                DB::transaction(function () use ($data, $product, $request, $amount, $fees, $payoutsXendit) {
                    //create transaction
                    $transaction = Transaction::create([
                        'no_inv' => $data['no_inv'],
                        'service' => $product->service->name,
                        'service_id' => $product->service_id,
                        'payment' => $data['payment'],
                        'user_id' => $request->user()->id,
                        'status' => $payoutsXendit['status'],
                        'link' => $payoutsXendit['invoice_url'],
                        'total' => $amount
                    ]);

                    // create detail transaction
                    $data['detail'] = $request->input('detail');
                    DetailTransaction::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product['id'],
                        'price' => $amount,
                        'qty' => $data['detail'][0]['qty'],
                        'no_hp' => $data['detail'][0]['no_hp'],
                        'status' => "PROCESS"
                    ]);
                    if ($data['point']) {
                        //deductpoint
                        $point = new Point;
                        $point->deductPoint($request->user()->id, abs($fees[1]['value']), $transaction->id);
                    }
                });

                return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
            }


            // response with link
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Transaction failed', 500);
        }
    }

    public function requestInquiry(Request $request)
    {
        try {
            $data = $request->all();

            // handle validation
            $validator = Validator::make($request->all(), [
                'no_pelanggan' => 'required',
                'nom' => 'required',
            ]);
            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Transaction failed', 500);
            }

            $requestMymili = $this->mymili->inquiry([
                'no_hp' => $data['no_pelanggan'],
                'nom' => $data['nom'],
            ]);

            if (str_contains($requestMymili['status'], "SUKSES")) {
                return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
            } else {
                return ResponseFormatter::error($requestMymili, 'Inquiry failed');
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Transaction failed', 500);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\DetailTransactionTopUp;
use App\Models\Fee;
use App\Models\HistoryPoint;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Mymili as ServicesMymili;
use App\Services\Point;
use App\Services\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\Xendit;

class TopUpController extends Controller
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

    public function getEWallet(Request $request)
    {
        $products = DB::table('products')->where('service_id', 11)
            ->distinct('name')->select('id', 'name')->get();


        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }
    public function detailEwallet(Request $request)
    {
        $products = Product::where([
            ['service_id', 11],
            ['name', 'like', '%' . strtoupper($request->name) . '%'],
            ['is_active', 1],
        ])->get();

        if ($products) {
            return ResponseFormatter::success($products, 'Data successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }

    public function testTopUP(Request $request)
    {
        $responseMili =  $this->mymili->paymentTopUp($request->invoice, $request->kode_pembayaran, $request->nomor_telfon);

        if ($responseMili['RESPONSECODE'] == 00) {
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sudah masuk',
                'response_mili' => $responseMili
            ]);
        } elseif ($responseMili['RESPONSECODE'] == 68) {
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sedang diproses'
            ]);
        }
    }

    // Pembayaran Top UP
    public function pembayaranPulsa(Request $request)
    {
        $data = $request->all();

        // handle validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'point' => 'required',
            'no_hp' => 'required',
            'kode_pembayaran' => 'required',
            'kode_unik' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['response' => $validator->errors()], 'Transaction failed', 500);
        }
        //Get Product
        $product = Product::with('service')->find($data['product_id']);

        // Check Service
        $service = $product->service->name == 'listrik-token' ? 'token' : $product->service->name;
        // Create invoice
        $data['no_inv'] = "INV-" . date('Ymd') . "-" . strtoupper($service) . "-" . time();

        // Get Fee by Product Service
        $fees = Fee::where('service_id', $product->service_id)->first();

        $fees = [
            [
                'type' => 'Fee Admin',
                'value' => $fees->percent == 0 ? $fees->value :  $product->price * $fees->value / 100,
            ],
            [
                'type' => 'Kode Unique',
                'value' => $data['kode_unik'],
            ],
        ];


        // Compare mili balance with total bill
        $saldoPointCustomer = 0;
        if ($request->point == 1) {
            // history point masuk dan keluar customer
            $pointCustomer = auth()->user()->point;

            $pointDigunakan = $pointCustomer * 10 / 100;

            array_push($fees, [
                'type' => 'point',
                'value' => 0 - $pointDigunakan,
            ]);
        }

        // total pembayaran termasuk dikurangi point
        $grandTotal = $product->price + $fees[0]['value'] + $data['kode_unik'] - $saldoPointCustomer;
        $requestSaldoMyMili = $this->mymili->saldo();
        $saldoMyMili = $requestSaldoMyMili['MESSAGE'];

        if ($saldoMyMili < $grandTotal) {
            return ResponseFormatter::error('Terjadi Kesalahan Pada Sistem', 'Inquiry failed');
        }

        $payoutsXendit = $this->xendit->create([
            'external_id' => $data['no_inv'],
            'items' => [
                [
                    'name' => $product->name . ' - ' . $product->description,
                    'quantity' => 1,
                    'price' => $product->price,
                    'url' => "someurl"
                ]
            ],
            'amount' => $grandTotal,
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees
        ]);


         if (isset($payoutsXendit['status'])) {
            $data['status'] = $payoutsXendit['status'];
            $data['link'] = $payoutsXendit['invoice_url'];
            $data['detail'] = $request->input('detail');

            // create transaction
            $transaction = Transaction::create([
                'no_inv' => $data['no_inv'],
                'service' => $product->service->name,
                'service_id' => $product->service_id,
                'payment' => 'xendit',
                'user_id' => \Auth::user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $grandTotal
            ]);

            // create detail transaction
            DetailTransactionTopUp::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $product->id,
                'nomor_telfon'   => $data['no_hp'],
                'total_tagihan'  => $grandTotal,
                'fee_travelsya'  => $fees[0]['value'],
                'fee_mili'       => 0,
                'message'        => 'Top UP sedang diproses',
                'status'         => "PROCESS",
                "kode_unik"      => $data['kode_unik'],
                "created_at" =>  Carbon::now()->timezone('Asia/Makassar')
            ]);


            // Jika user menggunakan point untuk transaksi dan xendit berhasil terbuat maka kurangin point customer
            if ($request->point == 1) {
                $point = new Point;
                $point->deductPoint(\Auth::user()->id, $pointDigunakan, $transaction->id);
            }
            return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
         }
    }
}

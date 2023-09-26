<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Fee;
use App\Models\HistoryPoint;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Mymili as ServicesMymili;
use App\Services\Point;
use App\Services\Setting;
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

    public function testTopUP(Request $request)
    {
        $responseMili =  $this->mymili->paymentTopUp($request->invoice, $request->kode_pembayaran, $request->nomor_telfon);
        if($responseMili['RESPONSECODE'] == 00)
        {
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sudah masuk'
            ]);
        }
        elseif($responseMili['RESPONSECODE'] == 68){
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sedang diproses'
            ]);
        }
    }
    public function pembayaranPulsa(Request $request)
    {
        $data = $request->all();

        // handle validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'point' => 'required',
            'no_hp' => 'required',
            'kode_pembayaran' => 'required',
        ]);
        $product = Product::with('service')->find($data['product_id']);
        $data['no_inv'] = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();

        $fees = Fee::where('service_id', $product->service_id)->first();

        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1)
        {
            // history point masuk dan keluar customer
            $pointCustomer = HistoryPoint::where('user_id', \Auth::user()->id)->first();
            // point masuk - point keluar
            $saldoPointCustomer = $pointCustomer->where('flow', '=', 'debit')->sum('point') - $pointCustomer->where('flow','=','credit')->sum('point') ?? 0;
        }

        // total pembayaran termasuk dikurangi point
        $grandTotal = $request->nominal_tagihan + $fees->value - $saldoPointCustomer;

        $payoutsXendit = $this->xendit->create([
            'external_id' => $data['no_inv'],
            'items' => [
                [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $grandTotal,
                    'url' => "someurl"
                ]
            ],
            'amount' => $grandTotal,
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => 'bagus',
                'email' => 'gustibagus34@gmail.com',
                'mobile_number' => '081253290605',
            ],
        ]);

        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');

        if (isset($payoutsXendit['status'])) {

            $data['status'] = $payoutsXendit['status'];
            $data['link'] = $payoutsXendit['invoice_url'];

            // create transaction
            $transaction = Transaction::create([
                'no_inv' => $data['no_inv'],
                'service' => $product->service->name,
                'service_id' => $product->service_id,
                'payment' => 'xendit',
                'user_id' => 2,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $grandTotal
            ]);

            // create detail transaction
            $data['detail'] = $request->input('detail');
            DB::table('detail_transaction_top_up')->insert([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'nomor_telfon' => $data['no_hp'],
                'total_tagihan' => $grandTotal,
                'fee_travelsya' => 2500,
                'fee_mili' => 2500,
                'message' => 'Pulsa sedang diproses',
                'status' => "PROCESS"
            ]);
            return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
        }
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\HistoryPoint;
use App\Models\Product;
use App\Services\Mymili as ServicesMymili;
use App\Services\Xendit;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use App\Models\DetailTransaction;
use App\Services\Point;
use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use Throwable;

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

    public function productTax()
    {
        $data = Product::where('is_active', '1')
            ->where(function ($q) {
                $q->where('name', 'SAMSAT')->orWhere('name','PBB');
            })
            ->get();

        return response()->json($data);
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
        $data = $request->all();

        // handle validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'nomor_tagihan' => 'required',
            'nominal_tagihan' => 'required',
            'point' => 'required',
            'kode_unik' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['response' => $validator->errors()], 'Transaction failed', 500);
        }
        //get data
        $product = Product::with('service')->find($request->product_id);
        $data['no_inv'] = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();

        $fees = Fee::where('service_id', $product->service_id)->first();
        $priceWithAdmin = $request->nominal_tagihan + $fees->value;

        $requestSaldoMyMili = $this->mymili->saldo();
        $saldoMyMili = $requestSaldoMyMili['MESSAGE'];

        if ($saldoMyMili < $priceWithAdmin) {
            return ResponseFormatter::error('Terjadi Kesalahan Pada Sistem', 'Inquiry failed');
        }

        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1) {
            // history point masuk dan keluar customer
            $pointCustomer = HistoryPoint::where('user_id', Auth::user()->id)->first();
            // point masuk - point keluar
            $saldo = $pointCustomer->where('flow', '=', 'debit')->sum('point') - $pointCustomer->where('flow', '=', 'credit')->sum('point') ?? 0;
             $saldoPointCustomer = $saldo * 10 /100;
            }

        //        // total pembayaran termasuk dikurangi point
        //        $grandTotal = $request->nominal_tagihan + $fees->value + $data['kode_unik'] - $saldoPointCustomer;

        // total pembayaran termasuk dikurangi point
        $grandTotal = $request->nominal_tagihan + $fees->value + $data['kode_unik'] - abs($saldoPointCustomer);

        // request xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $data['no_inv'],
            'items' => [
                ['name' => $product->name . ' (' . $request->nomor_tagihan . ')',
                'quantity' => 1,
                'price' => $grandTotal,
                'url' => 'someurl']
            ],
            'amount' => $grandTotal,
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => 'Gusti Bagus',
                 'email' => 'gustibagus34@gmail.com',
                  'mobile_number' => '081253290605'
                  ]]);

        if (isset($payoutsXendit['status'])) {
            $data['status'] = $payoutsXendit['status'];
            $data['link'] = $payoutsXendit['invoice_url'];

            $transaction = Transaction::create([
                'no_inv' => $data['no_inv'],
                'service' => $product->service->name,
                'service_id' => $product->service_id,
                'payment' => 'xendit',
                'user_id' => 3,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $grandTotal
            ]);

            // create detail transaction
            $data['detail'] = $request->input('detail');

            DB::table('detail_transaction_ppob')->insert([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'nomor_pelanggan' => $request->nomor_tagihan,
                'total_tagihan' => $grandTotal,
                'fee_travelsya' => 2500,
                'fee_mili' => 100,
                'message' => 'Sedang menunggu pembayaran',
                'status' => 'PROCESS',
                'kode_unik' => $data['kode_unik'],
                'created_at' => Carbon::now()->timezone('Asia/Makassar')
            ]);

            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $transaction->id);

                //                // history point masuk dan keluar customer
                //                $pointCustomer = HistoryPoint::where('user_id', Auth::user()->id)->first();
                //                // point masuk - point keluar
                //                $saldoPointCustomer = $pointCustomer->where('flow', '=', 'debit')->sum('point') - $pointCustomer->where('flow', '=', 'credit')->sum('point') ?? 0;
            }

            return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
        }
    }

    public function requestInquiry(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'no_pelanggan' => 'required',
                'nom' => 'required'
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(['response' => $validator->errors()], 'Transaction failed', 500);
            }

            $requestMymili = $this->mymili->inquiry(['no_hp' => $data['no_pelanggan'], 'nom' => $data['nom']]);

            $fee_admin = Product::with('service')->find(362)->price; // 442 untuk kode PAYPLN, 362 untuk kode PAYBPJS

            if (str_contains($requestMymili['status'], 'SUKSES!')) {
                return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
            } else {
                if (str_contains($requestMymili['status'], 'SUDAH LUNAS')) {
                    $status = 'Tagihan Sudah Terbayar';
                }

                if (str_contains($requestMymili['status'], 'Bills already paid')) {
                    $status = 'Tagihan Sudah Terbayar';
                }

                if (str_contains($requestMymili['status'], 'IDPEL SALAH')) {
                    $status = 'Nomor Tagihan Tidak Dikenali';
                }

                if (str_contains($requestMymili['status'], 'NOMOR PELANGGAN SALAH')) {
                    $status = 'Nomor Tagihan Tidak Dikenali';
                }

                if (str_contains($requestMymili['status'], 'NOMOR YANG ANDA MASUKAN SALAH')) {
                    $status = 'Nomor Tagihan Tidak Dikenali';
                }

                if (str_contains($requestMymili['status'], ' IP belum terdaftar')) {
                    $status = 'IP pada sistem ini belum terdaftar pada mili';
                }

                return ResponseFormatter::error($status, 'Inquiry failed');
            }
        } catch (Throwable $th) {
            return ResponseFormatter::error([], 'Terjadi kesalahan pada sistem', 500);
        }
    }
}

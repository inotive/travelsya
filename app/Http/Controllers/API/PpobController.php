<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\HistoryPoint;
use App\Models\Product;
use App\Models\User;
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

    // Pembayaran Tagihan
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
        //Get Product
        $product = Product::with('service')->find($request->product_id);

        // Generate Invoice
        $data['no_inv'] = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();

        // Get Fee by Product Service
        $fee = Fee::where('service_id', $product->service_id)->first();
        $uniqueCode = rand(111, 999);

        $fees = [
            [
                'type' => 'Biaya Layanan',
                'value' => $fee->percent == 0 ? $fee->value :  $product->price * $fee->value / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $uniqueCode,
            ],
        ];

        // Compare mili balance with total bill
        $priceWithAdmin = $request->nominal_tagihan + $fees['0']['value'];
        $requestSaldoMyMili = $this->mymili->saldo();
        $saldoMyMili = $requestSaldoMyMili['MESSAGE'];

        if ($saldoMyMili < $priceWithAdmin) {
            return ResponseFormatter::error('Terjadi Kesalahan Pada Sistem', 'Inquiry failed');
        }

        // Check User using point or no when he pays
        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1) {
            $pointCustomer = auth()->user()->point;
            $saldoPointCustomer = round($pointCustomer * 10 / 100);

            array_push($fees, [
                'type' => 'Point',
                'value' => 0 - $saldoPointCustomer,
            ]);
        }
        // total pembayaran termasuk dikurangi point
        $grandTotal = $request->nominal_tagihan + $fees[0]['value'] + $data['kode_unik'] - abs($saldoPointCustomer);

        // request xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $data['no_inv'],
            'items' => [
                ['name' => $product->name . ' (' . $request->nomor_tagihan . ')',
                'quantity' => 1,
                'price' => $request->nominal_tagihan,
                'url' => 'someurl'
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

            $transaction = Transaction::create([
                'no_inv' => $data['no_inv'],
                'service' => $product->service->name,
                'service_id' => $product->service_id,
                'payment' => 'xendit',
                'user_id' => auth()->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $grandTotal
            ]);

            $data['detail'] = $request->input('detail');

            DB::table('detail_transaction_ppob')->insert([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'nomor_pelanggan' => $request->nomor_tagihan,
                'total_tagihan' => $grandTotal,
                'fee_travelsya' => $fees[0]['value'],
                'fee_mili' => 0,
                'message' => 'Sedang menunggu pembayaran',
                'status' => 'PROCESS',
                'kode_unik' => $data['kode_unik'],
                'created_at' => Carbon::now()->timezone('Asia/Makassar')
            ]);

            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $transaction->id);
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

//            $fee_admin = Product::with('service')->find(362)->price; // 442 untuk kode PAYPLN, 362 untuk kode PAYBPJS

            if (str_contains($requestMymili['status'], 'SUKSES')) {
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

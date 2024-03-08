<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fee;
use App\Models\Product;
use App\Services\Point;
use App\Helpers\General;
use App\Services\Mymili;
use App\Services\Xendit;
use App\Services\Setting;
use App\Models\Transaction;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailTransactionTopUp;
use Illuminate\Http\Client\ResponseSequence;

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
        $data = Product::where([['category', '=', $category], ['name', 'like', '%' . strtoupper($provider) . '%'], ['is_active', '=', 1]])->get();

        return response()->json($data);
    }

    public function paymentPulsaData(Request $request)
    {
        $data = $request->all();
        $point = new Point();

        $product = Product::with('service')->find($data['product']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();
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
        }

        $sellingPrice = $request->point !== null ?  $product->price - abs($pointDigunakan) :  $product->price;
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;

        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => $product->name . ' - ' . $product->description,
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);

        if (isset($payoutsXendit['status'])) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => $product->service->name . '-' . time(),
                'service' => $product->service->name,
                'service_id' => $product->service->id,
                'payment' => 'xendit',
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount,
            ]);

            $helper = new General();

            DetailTransactionTopUp::create([
                'transaction_id' => $storeTransaction->id,
                'product_id' => $product->id,
                'nomor_telfon' => $data['notelp'],
                'total_tagihan' => $amount,
                'fee_travelsya' => $fees[0]['value'],
                'fee_mili' => 0,
                'message' => 'Sedang menunggu pembayaran',
                'status' => 'PROCESS',
                'kode_unik' => $uniqueCode,
                'created_at' => Carbon::now(),
            ]);

            if ( $request->point !== null) {
                //deductpoint
                $point = new Point();
                $point->deductPoint($request->user()->id, $pointDigunakan, $storeTransaction->id);
            }
        }

        return redirect($payoutsXendit['invoice_url']);
    }

    public function data()
    {
        return view('product.data');
    }

    public function bpjs(Request $request)
    {
        // return view('product.bpjs');
        $data = $request->all();

        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $data['no_pelanggan'],
            'nom' => $data['nom'],
        ]);

        if (str_contains($requestMymili['status'], 'SUKSES')) {
            $requestMymili['fee'] = $this->getAdminFee(5, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            $status = '';
            if (str_contains($requestMymili['status'], 'SUDAH LUNAS')) {
                $status = 'Tagihan Sudah Lunas';
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
            if (str_contains($requestMymili['status'], " GAGAL!")) {
                $status = "Sistem gagal melakukan pengecekan tagihan";
            }

            return ResponseFormatter::error($status, 'Inquiry failed');
        }
    }

    public function paymentBpjs(Request $request)
    {
        $data = $request->all();

        $point = new Point();

        $product = Product::with('service')->find($data['product_id']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();

        $setting = new Setting();

        // Get Fee by Product Service
        $fees = Fee::where('service_id', $product->service_id)->first();
        $uniqueCode = rand(111, 999);

        $fees = [
            [
                'type' => 'admin',
                'value' => $fees->percent == 0 ? $fees->value :  $data['totalTagihan'] * $fees->value / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $uniqueCode,
            ],
        ];

        $poitnDigunakan = 0;
        if ( $request->point !== null) {
            $poitnDigunakan = $request->point * 10 / 100;
        }

        $sellingPrice = $request->point !== null ? $data['totalTagihan'] - abs($poitnDigunakan) : $data['totalTagihan'];
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;

        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganBPJS']),
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'BPJS-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount,
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id' => $storeTransaction->id,
            'product_id' => $product->id,
            'nomor_pelanggan' => $request->noPelangganBPJS,
            'total_tagihan' => $amount,
            'fee_travelsya' => $fees[0]['value'],
            'fee_mili' => 0,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => $uniqueCode,
            'created_at' => Carbon::now(),
        ]);

        if ($request->point !== null) {
            $point = new Point();
            $point->deductPoint($request->user()->id, $poitnDigunakan, $storeTransaction->id);
        }
        return redirect($payoutsXendit['invoice_url']);
    }

    public function pdam(Request $request)
    {
        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $request->no_pelanggan,
            'nom' => $request->nom,
        ]);

        if (str_contains($requestMymili['status'], 'SUKSES') || str_contains($requestMymili['status'], "SUKSES")) {
            $requestMymili['fee'] = $this->getAdminFee(6, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            $status = '';
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
    }

    public function productPdam()
    {
        $data = Product::where([['category', 'negara'], ['name', 'PDAM'], ['is_active', '=', 1]])->get();

        return response()->json($data);
    }

    public function paymentPdam(Request $request)
    {
        $data = $request->all();

        $point = new Point();
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productPDAM']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();
        $setting = new Setting();

        // Get Fee by Product Service
        $fees = Fee::where('service_id', $product->service_id)->first();
        $uniqueCode = rand(111, 999);

        $fees = [
            [
                'type' => 'admin',
                'value' => $fees->percent == 0 ? $fees->value :  $data['totalTagihan'] * $fees->value / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $uniqueCode,
            ],
        ];


        $poitnDigunakan = 0;
        if ( $request->point !== null) {
            $poitnDigunakan = $request->point * 10 / 100;
        }

        $sellingPrice = $request->point !== null ? $data['totalTagihan'] - abs($poitnDigunakan) : $data['totalTagihan'];
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;
        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPDAM']),
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'PDAM-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount,
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id' => $storeTransaction->id,
            'product_id' => $product->id,
            'nomor_pelanggan' => $request->noPelangganPDAM,
            'total_tagihan' => $amount,
            'fee_travelsya' => $fees[0]['value'],
            'fee_mili' => 0,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => $uniqueCode,
            'created_at' => Carbon::now(),
        ]);

        if ($request->point == 1) {
            //deductpoint
            $point = new Point();
            $point->deductPoint($request->user()->id, $poitnDigunakan, $storeTransaction->id);
        }

        return redirect($payoutsXendit['invoice_url']);
    }

    public function pln(Request $request)
    {
        // return view('product.pln');
        $data = $request->all();
        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $data['no_pelanggan'],
            'nom' => $data['nom'],
        ]);

        if (str_contains($requestMymili['status'], 'SUKSES')) {
            $requestMymili['fee'] = $this->getAdminFee(3, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            $status = '';
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

    }

    public function productPln()
    {
        $data = Product::where([['category', 'pln'], ['description', 'like', '%token%'], ['is_active', '=', 1]])->get();

        return response()->json($data);
    }

    public function paymentPln(Request $request)
    {
        $data = $request->all();
        $point = new Point();
        $userPoint = $point->cekPoint(auth()->user()->id);
        $product = Product::with('service')
            ->where('id', $request->productPLN)
            ->first();
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();
        $setting = new Setting();

        // Get Fee by Product Service
        $fees = Fee::where('service_id', $product->service_id)->first();

        $uniqueCode = rand(111, 999);

        $fees = [
            [
                'type' => 'Fee Admin',
                'value' => $fees->percent == 0 ? $fees->value :  $product->price * $fees->value / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $uniqueCode,
            ],
        ];

        $poitnDigunakan = 0;
        if ( $request->point !== null) {
            $poitnDigunakan = $request->point * 10 / 100;
        }

        $sellingPrice = $request->point !== null ? $product->price - abs($poitnDigunakan) : $product->price;
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;
        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPLN']),
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);
        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'PLN-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount,
        ]);

        if ($request->categoryPLN == 'token') {
            DB::table('detail_transaction_top_up')->insert([
                'transaction_id' => $storeTransaction->id,
                'product_id' => $product->id,
                'nomor_telfon' => $request->noPelangganPLN,
                'total_tagihan' => $amount,
                'fee_travelsya' => $fees[0]['value'],
                'fee_mili' => 0,
                'message' => 'Sedang menunggu pembayaran',
                'status' => 'PROCESS',
                'kode_unik' => $uniqueCode,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            DB::table('detail_transaction_ppob')->insert([
                'transaction_id' => $storeTransaction->id,
                'product_id' => $product->id,
                'nomor_pelanggan' => $request->noPelangganPLN,
                'total_tagihan' => $amount,
                'fee_travelsya' => $fees[0]['value'],
                'fee_mili' => 0,
                'message' => 'Sedang menunggu pembayaran',
                'status' => 'PROCESS',
                'kode_unik' => $uniqueCode,
                'created_at' => Carbon::now(),
            ]);
        }

        if ($request->point == 1) {
            //deductpoint
            $point = new Point();
            $point->deductPoint($request->user()->id, abs($poitnDigunakan), $storeTransaction->id);
        }

        return redirect($payoutsXendit['invoice_url']);
    }

    public function tvInternet(Request $request)
    {
        // return view('product.tv');

        $data = $request->all();

        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $data['no_pelanggan'],
            'nom' => $data['nom'],
        ]);

        if (str_contains($requestMymili['status'], 'SUKSES')) {
            $requestMymili['fee'] = $this->getAdminFee(10, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            $status = '';
            if (str_contains($requestMymili['status'], 'SUDAH LUNAS')) {
                $status = 'Tagihan Sudah Terbayar';
            }
            else if (str_contains($requestMymili['status'], "INVALID! Produk sementara tidak tersedia!")) {
                $status = "Tagihan Sudah Terbayar";
            }
            else if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }
            else if (str_contains($requestMymili['status'], "ERROR 88 TRANSAKSI DITOLAK")) {
                $status = "Tagihan Sudah Terbayar";
            }
            else if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }
            else if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }
            else if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }
            else if (str_contains($requestMymili['status'], " IP belum terdaftar")) {
                $status = "IP pada sistem ini belum terdaftar pada mili";
            }
            else{
                $status = "Gagal melakukan pengecekan tagihan";
            }

            return ResponseFormatter::error($status, 'Inquiry failed');
        }
    }

    public function productTvInternet()
    {
        $data = Product::where('category', 'tv-internet')
            ->where('is_active', 1)
            ->distinct()
            ->get();

        return response()->json($data);
    }

    public function paymentTvInternet(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $point = new Point();
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productTV']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service?->name) . '-' . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];

        $poitnDigunakan = 0;
        if ( $request->point !== null) {
            $poitnDigunakan = $request->point * 10 / 100;
        }

        $sellingPrice = $request->point !== null ? $data['totalTagihan'] -  abs($poitnDigunakan) : $data['totalTagihan'];
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;
        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganTV']),
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'TV-INTERNET-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount,
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id' => $storeTransaction->id,
            'product_id' => $product->id,
            'nomor_pelanggan' => $request->noPelangganTV,
            'total_tagihan' => $amount,
            'fee_travelsya' => $fees[0]['value'],
            'fee_mili' => 0,
            'message' => 'Sedang menunggu pembayaran',
            'status' => 'PROCESS',
            'kode_unik' => $uniqueCode,
            'created_at' => Carbon::now(),
        ]);

        if ($request->point == 1) {
            //deductpoint
            $point = new Point();
            $point->deductPoint($request->user()->id, abs($poitnDigunakan), $storeTransaction->id);
        }

        return redirect($payoutsXendit['invoice_url']);
    }

    public function tax(Request $request)
    {
        // return view('product.tax');

        $data = $request->all();

        $requestMymili = $this->mymili->inquiry([
            'no_hp' => $data['no_pelanggan'],
            'nom' => $data['nom'],
        ]);

        if (str_contains($requestMymili['status'], 'SUKSES')) {
            $requestMymili['fee'] = $this->getAdminFee(6, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            $status = '';
            if (str_contains($requestMymili['status'], 'SUDAH LUNAS')) {
                $status = 'Tagihan Sudah Terbayar';
            }

            if (str_contains($requestMymili['status'], 'Bills already paid')) {
                $status = 'Tagihan Sudah Terbayar';
            }

            if (str_contains($requestMymili['status'], 'INVALID! Produk sementara tidak tersedia!')) {
                $status = 'Tagihan Sudah Terbayar atau Nomor Tagihan Tidak Dikenali';
            }

            if (str_contains($requestMymili['status'], 'INVALID! Produk tidak tersedia')) {
                $status = 'Nomor Tagihan Tidak Dikenali';
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

    public function paymentTax(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $point = new Point();
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productPajak']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper($product->service->name) . '-' . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);

        $poitnDigunakan = 0;
        if ( $request->point !== null) {
            $poitnDigunakan = $request->point * 10 / 100;
        }

        $sellingPrice = $request->point !== null ? $data['totalTagihan'] - abs($poitnDigunakan) : $data['totalTagihan'];
        $sellingPriceFinal = $sellingPrice <= 0 ? 0 : $sellingPrice;
        $amount = $setting->getAmount($sellingPriceFinal, 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $product->id,
                    'name' => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPajak']),
                    'price' => $sellingPriceFinal,
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount,
            'success_redirect_url' => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: 'somenumber',
            ],
            'fees' => $fees,
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'TAX-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount,
        ]);

        DetailTransaction::create([
            'transaction_id' => $storeTransaction->id,
            'product_id' => $data['productPajak'],
            'price' => $amount,
            'qty' => 1,
            'no_hp' => $request->user()->phone,
            'status' => 'PROCESS',
        ]);

        //deductpoint
        if ($request->point == 1) {
            //deductpoint
            $point = new Point();
            $point->deductPoint($request->user()->id, abs($poitnDigunakan), $storeTransaction->id);
        }

        return redirect($payoutsXendit['invoice_url']);
    }

    public function getAdminFee($service_id, $price)
    {
        $fee = Fee::where('service_id', $service_id)->first();

        if ($fee->percent) {
            $feeValue = $price * ($fee->value / 100);
        } else {
            $feeValue = $fee->value;
        }

        return $feeValue;
    }

    public function show($product)
    {
        return view('product.detail-product');
    }

    public function ajaxPpob(Request $request)
    {
        try {
            $data = $request->all();

            if ($data['operator'] == 3) {
                $data['operator'] = 'three';
            }

            if ($data['operator'] == 'Indosat Ooredoo') {
                $data['operator'] = 'indosat';
            }

            if ($data['operator'] == 'XL Axiata') {
                $data['operator'] = 'xl';
            }

            $pricelist = $this->travelsya->pricelist();

            if ($pricelist['meta']['code'] != 200) {
                return response()->json(['message' => 'not found']);
            }

            $category = array_filter($pricelist['data'], function ($var) use ($data) {
                return $var['category'] == $data['category'];
            });

            $pulsa = array_filter($category, function ($var) use ($data) {
                // return ($var['name'] == $data['operator']);
                return str_contains($var['name'], strtoupper($data['operator']));
            });

            return response()->json($pulsa);
        } catch (\Throwable $th) {
            return response()->json($pricelist);
        }
    }
}

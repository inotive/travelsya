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
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];
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
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

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

        // dd($requestMymili);

        
        $status = '';
        if (str_contains($requestMymili['status'], "SUKSES!")) {
            $requestMymili['fee'] = $this->getAdminFee(5, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            if (str_contains($requestMymili['status'], "SUDAH LUNAS")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            return ResponseFormatter::error('Tidak ada', 'Inquiry failed');
        }


        // return [
        //     "meta" => [
        //         "code" => 200,
        //         "status" => "success",
        //         "message" => "Inquiry loaded"
        //     ],
        //     "data" => [
        //         "status" => "SUKSES!",
        //         "nama_pelanggan" => "GUSTI BAGUS WAHYU SAPUTRA",
        //         "tagihan" => "152500"
        //     ]
        // ];
    }

    public function paymentBpjs(Request $request)
    {
        $data = $request->all();

        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['product_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];
        $amount = $setting->getAmount($data['totalTagihan'], 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganBPJS']),
                    "price" => $data['totalTagihan'],
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
            'req_id' => 'BPJS-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id'  => $storeTransaction->id,
            'product_id'      => $product->id,
            'nomor_pelanggan' => $request->noPelangganBPJS,
            'total_tagihan'   => $amount,
            'fee_travelsya'  => $fees[0]['value'],
            'fee_mili'       => 0,
            'message'         => 'Sedang menunggu pembayaran',
            'status'          => "PROCESS",
            "kode_unik"       => $uniqueCode,
            "created_at" => Carbon::now()
        ]);

        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

        return redirect($payoutsXendit['invoice_url']);
    }

    public function pdam(Request $request)
    {
        // return view('product.pdam');

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

        // return [
        //     "meta" => [
        //         "code" => 200,
        //         "status" => "success",
        //         "message" => "Inquiry loaded"
        //     ],
        //     "data" => [
        //         "status" => "SUKSES!",
        //         "nama_pelanggan" => "ERIKH",
        //         "tagihan" => "346034"
        //     ]
        // ];

        dd($requestMymili);

        if (str_contains($requestMymili['status'], "SUKSES!")) {
            $requestMymili['fee'] = $this->getAdminFee(6, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            if (str_contains($requestMymili['status'], "SUDAH LUNAS")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            return ResponseFormatter::error($status, 'Inquiry failed');
        }
    }

    public function productPdam()
    {
        $data = Product::where([
            ['category', 'negara'],
            ['name', 'PDAM'],
            ['is_active', '=', 1],
        ])->get();

        return response()->json($data);
    }

    public function paymentPdam(Request $request)
    {
        $data = $request->all();

        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productPDAM']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];
        $amount = $setting->getAmount($data['totalTagihan'], 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPDAM']),
                    "price" => $data['totalTagihan'],
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
            'req_id' => 'PDAM-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id'  => $storeTransaction->id,
            'product_id'      => $product->id,
            'nomor_pelanggan' => $request->noPelangganPDAM,
            'total_tagihan'   => $amount,
            'fee_travelsya'  => $fees[0]['value'],
            'fee_mili'       => 0,
            'message'         => 'Sedang menunggu pembayaran',
            'status'          => "PROCESS",
            "kode_unik"       => $uniqueCode,
            "created_at" => Carbon::now()
        ]);

        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);


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

        if (str_contains($requestMymili['status'], "SUKSES!")) {
            $requestMymili['fee'] = $this->getAdminFee(3, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            if (str_contains($requestMymili['status'], "SUDAH LUNAS")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            return ResponseFormatter::error($status, 'Inquiry failed');
        }

        // return [
        //     "meta" => [
        //         "code" => 200,
        //         "status" => "success",
        //         "message" => "Inquiry loaded"
        //     ],
        //     "data" => [
        //         "status" => "TRX CEKPLN 232010890459 SUKSES! SN=0000",
        //         "tagihan" => "82636",
        //         "no_pelanggan" => "232010890459",
        //         "ref_id" => "01CC48035A4E4DCAB5C0000000000000",
        //         "nama_pelanggan" => "ERNA SARI",
        //         "bulan_tahun_tagihan" => "Jun23",
        //         "pemakaian" => "39212-3924"
        //     ],
        // ];
    }

    public function productPln()
    {
        $data = Product::where([
            ['category', 'pln'],
            ['description', 'like', '%token%'],
            ['is_active', '=', 1],
        ])->get();

        return response()->json($data);
    }

    public function paymentPln(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->where('id', $request->productPLN)->first();
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];
        $amount = $setting->getAmount($product->price, 1, $fees, 1);
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPLN']),
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

        // dd($payoutsXendit);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'PLN-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount
        ]);


        if($product->service->name == "listrik-token")
        {
            DB::table('detail_transaction_top_up')->insert([
                'transaction_id'  => $storeTransaction->id,
                'product_id'      => $product->id,
                'nomor_telfon' => $request->noPelangganPLN,
                'total_tagihan'   => $amount,
                'fee_travelsya'  => $fees[0]['value'],
                'fee_mili'       => 0,
                'message'         => 'Sedang menunggu pembayaran',
                'status'          => "PROCESS",
                "kode_unik"       => $uniqueCode,
                "created_at" => Carbon::now()
            ]);
        }
        {
            DB::table('detail_transaction_ppob')->insert([
                'transaction_id'  => $storeTransaction->id,
                'product_id'      => $product->id,
                'nomor_pelanggan' => $request->noPelangganPLN,
                'total_tagihan'   => $amount,
                'fee_travelsya'  => $fees[0]['value'],
                'fee_mili'       => 0,
                'message'         => 'Sedang menunggu pembayaran',
                'status'          => "PROCESS",
                "kode_unik"       => $uniqueCode,
                "created_at" => Carbon::now()
            ]);
        }
        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

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
        if (str_contains($requestMymili['status'], "SUKSES!")) {
            $requestMymili['fee'] = $this->getAdminFee(10, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            if (str_contains($requestMymili['status'], "SUDAH LUNAS")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "INVALID! Produk sementara tidak tersedia!")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "ERROR 88 TRANSAKSI DITOLAK")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
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

        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productTV']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $uniqueCode,
        ];
        $amount = $setting->getAmount($data['totalTagihan'], 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganTV']),
                    "price" => $data['totalTagihan'],
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
            'req_id' => 'TV-INTERNET-' . time(),
            'service' => $product->service->name,
            'service_id' => $product->service->id,
            'payment' => 'xendit',
            'user_id' => $request->user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => $amount
        ]);

        DB::table('detail_transaction_ppob')->insert([
            'transaction_id'  => $storeTransaction->id,
            'product_id'      => $product->id,
            'nomor_pelanggan' => $request->noPelangganTV,
            'total_tagihan'   => $amount,
            'fee_travelsya'  => $fees[0]['value'],
            'fee_mili'       => 0,
            'message'         => 'Sedang menunggu pembayaran',
            'status'          => "PROCESS",
            "kode_unik"       => $uniqueCode,
            "created_at" => Carbon::now()
        ]);

        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

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

        if (str_contains($requestMymili['status'], "SUKSES!")) {
            $requestMymili['fee'] = $this->getAdminFee(6, $requestMymili['tagihan']);
            return ResponseFormatter::success($requestMymili, 'Inquiry loaded');
        } else {
            if (str_contains($requestMymili['status'], "SUDAH LUNAS")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "Bills already paid")) {
                $status = "Tagihan Sudah Terbayar";
            }

            if (str_contains($requestMymili['status'], "INVALID! Produk sementara tidak tersedia!")) {
                $status = "Tagihan Sudah Terbayar atau Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "INVALID! Produk tidak tersedia")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "IDPEL SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR PELANGGAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            if (str_contains($requestMymili['status'], "NOMOR YANG ANDA MASUKAN SALAH")) {
                $status = "Nomor Tagihan Tidak Dikenali";
            }

            return ResponseFormatter::error($status, 'Inquiry failed');
        }
    }

    public function productTax()
    {
        $data = Product::where('name', 'PBB')
            ->where('is_active', 1)
            ->distinct()
            ->get();

        return response()->json($data);
    }

    public function paymentTax(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $point = new Point;
        $userPoint = $point->cekPoint(auth()->user()->id);

        $product = Product::with('service')->find($data['productPajak']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($product->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);
        $amount = $setting->getAmount($data['totalTagihan'], 1, $fees, 1);

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $product->id,
                    "name" => strtoupper($product->description) . ' - ' . strtoupper($data['noPelangganPajak']),
                    "price" => $data['totalTagihan'],
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
            'req_id' => 'TAX-' . time(),
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
            'product_id' => $data['productPajak'],
            'price' => $amount,
            'qty' => 1,
            'no_hp' => $request->user()->phone,
            'status' => "PROCESS"
        ]);

        //deductpoint
        $point = new Point;
        $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);

        return redirect($payoutsXendit['invoice_url']);
    }

    public function getAdminFee($service_id, $price)
    {
        // $data = $request->all();

        // $point = new Point;
        // $userPoint = $point->cekPoint(auth()->user()->id);

        // $product = Product::with('service')->find($data['idProduct']);
        // $setting = new Setting();
        // $fees = $setting->getFees($userPoint, $product->service->id, $request->user()->id, $product->price);

        // return $fees;

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

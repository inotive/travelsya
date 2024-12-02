<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\ClinicHasPackages;
use App\Models\DetailTransactionHealthBeauty;
use App\Models\Fee;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class NewHealthBeautyController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }
    public function index()
    {
        $special = Clinic::Active()->with('reviews', 'packages', 'kota')
            ->whereHas('packages', function ($p) {
                $p->whereColumn('unit_price', '>', 'price');
            })
            ->limit(10)
            ->get();

        $special_deals = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                foreach ($rec['packages'] as $key => $value) {
                    $item = [
                        'id' => $rec['id'],
                        'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                        'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                        'clinic' => $rec['clinic_name'],
                        'name' => $value['name'],
                        'rate' => $rec->avgRating(),
                        'category' => $rec['category'],
                        'origin_price' => (int)$value['unit_price'],
                        'cut_price' => $value['price'],
                        'rating_count' => count($rec['reviews']),
                    ];
                    array_push($special_deals, $item);
                }

            }
        }

        $categories = CategoriesServices::get();

        $partners = Clinic::with('packages')->orderBy('created_at', 'desc')->get();

        $data['special_deals'] = collect($special_deals);
        $data['categorises'] = collect($categories);
        $data['partners'] = collect($partners);

        return view('pagesv2.health_beauty.index', $data);
    }

    public function show_special_deals(){
        $special = Clinic::Active()->with('reviews', 'packages', 'kota')
            ->whereHas('packages', function ($p) {
                $p->whereColumn('unit_price', '>', 'price');
            })
            ->limit(10)
            ->get();

        $special_deals = [];

        foreach ($special as $key => $rec) {
            if (count($rec['packages']) > 0) {
                $item = [
                    'id' => $rec['id'],
                    'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                    'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'name' => $rec['clinic_name'],
                    'rate' => $rec->avgRating(),
                    'category' => $rec['category'],
                    'origin_price' => (int)$rec['packages'][0]['unit_price'],
                    'cut_price' => $rec['packages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                ];

                array_push($special_deals, $item);
            }
        }

        $item = [
            'id' => 4,
            'img' => 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg',
            'lokasi' => 'Kota Dihapus',
            'name' => 'klinik baru A',
            'rate' => 4.75,
            'category' => 'health',
            'origin_price' => 350000,
            'cut_price' => 275000,
            'rating_count' => 189,
        ];

        array_push($special_deals, $item);

        $item = [
            'id' => 5,
            'img' => 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg',
            'lokasi' => 'Kota Dihapus',
            'name' => 'klinik baru B',
            'rate' => 4.85,
            'category' => 'health',
            'origin_price' => 450000,
            'cut_price' => 399000,
            'rating_count' => 2500,
        ];

        array_push($special_deals, $item);

        $special_deals = json_decode(json_encode($special_deals));

        $data['special_deals'] = collect($special_deals);

        return view('pagesv2.health_beauty.show_special_deals', $data);
    }

    public function show(Request $request){
        $clinics = [
            [
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 1',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 2',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 3',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 4',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 5',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'denpasar',
                'name' => 'Product 6',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 7',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 8',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 9',
                'category' => 'beauty',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 10',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 11',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 12',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 13',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 14',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 15',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],[
                'img' => '',
                'lokasi' => 'jakarta',
                'name' => 'Product 16',
                'category' => 'health',
                'rate' => '4.8',
                'origin_price' => 250000,
                'cut_price' => 175000,
            ],
        ];
        $clinics = json_decode(json_encode($clinics));
        $data['clinics'] = collect($clinics)->filter(function($clinic) use ($request){
            return $clinic->category == $request->category;
        });
        return view('pagesv2.health_beauty.show', $data);
    }

    public function detail(Request $request, $lokasi, $clinic, $id = null){
        if($id){
            $data['clinic'] = Clinic::find($id);
        }else{
            $data['clinic'] = null;
        }

        return view('pagesv2.health_beauty.detail', $data);
    }

    public function order(Request $request, $clinic){
        $user = Auth::user();

        if($user){
            $data['paket'] = ClinicHasPackages::find($request->package_id);
            $data['qty'] = $request->total_ticket;
            $data['user'] = $user;
            $data['type'] = $data['paket']['clinic']['category'];
            $data['service_id'] = Service::where('name', $request->service)->first()['id'];

            return view('pagesv2.health_beauty.order', $data);
        }else{
            return redirect()->route('login');
        }

    }

    public function request_transaction(Request $request){
        $data = $request->all();

        $package = ClinicHasPackages::find($data['package_id']);

        $now =  date('Y-m-d');

        $expire = Carbon::parse($now)->addDays($package['expiry_date'])->addHours(23)->format('Y-m-d H:i:s');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('healthbeauty') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting;
        $fees = $setting->getFees($data['point'], $service['id'], Auth::user()->id, $package->price);


        $amount = $package->price * $data['total_ticket'];

        $kode_unik = random_int(0, 999);

        $fee = Fee::whereHas('service', function ($s) use ($data) {
            $s->where('name', $data['service']);
        })->first();
        $fees = [
            [
                'type' => 'Admin',
                'value' => $fee->percent == 0 ? $fee->value : ($amount * $fee->value) / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $kode_unik,
            ],
        ];

        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1) {
            // history point masuk dan keluar customer
            //            $pointCustomer = HistoryPoint::where('user_id', Auth::user()->id)->first();
            // point masuk - point keluar
            //            $saldoPointCustomer = $pointCustomer->where('flow', '=', 'debit')->sum('point') - $pointCustomer->where('flow', '=', 'credit')->sum('point') ?? 0;
            $saldoPointCustomer = Auth::user()->point;
            $fees = [
                [
                    'type' => 'Point',
                    'value' => $saldoPointCustomer,
                ],
            ];
        }

        // Create xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $data['package_id'],
                    'name' => $package['name'] ?? 'Invalid clinic',
                    'price' => $amount, // tanpa pajak
                    'quantity' => $data['total_ticket'],
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $kode_unik, // include pajak
            'success_redirect_url' => route('user.orderHistory'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => Auth::user()->name,
                'email' => Auth::user()->email,
                'mobile_number' => Auth::user()->phone ?? '000000000000',
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $expire, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $package, $saldoPointCustomer) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HNB-' . time(),
                'service' => $data['service'],
                'service_id' => $service['id'],
                'payment' => $data['payment'],
                'user_id' => Auth::user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount + $fees[0]['value'] + $kode_unik,
            ]);
            // Pengurangan Point
            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint(Auth::user()->id, $saldoPointCustomer, $storeTransaction->id);
            }

            DetailTransactionHealthBeauty::create([
                "transaction_id" => $storeTransaction->id,
                "clinic_id" => $package['clinic_id'],
                "clinic_package_id" => $package['id'],
                "category" => $package['clinic']['category'] ?? 'Deleted clinic',
                "booking_id" => Str::random(6),
                "expire_on" => $expire,
                "rent_price" => $package->price,
                "fee_admin" => $fees[0]['value'],
                "kode_unik" => $kode_unik,
                "total_ticket" => $data['total_ticket'],
                "customer_name" => $data['sapa_pemesan'] .' '. $data['nama_pemesan'],
                "customer_phone" => $data['phone_pemesan'],
                "customer_email" => $data['email_pemesan'],
                "is_used" => 0,
            ]);

            try {
                // $storeDetailTransaction = DB::table('detail_transaction_recreations')->insert([
                //     "transaction_id" => $storeTransaction->id,
                //     "recreation_id" => $package['recreation_id'],
                //     "recreationPackage_id" => $package['id'],
                //     "booking_id" => Str::random(6),
                //     "expire_on" => $expire,
                //     "rent_price" => $package->price,
                //     "fee_admin" => $fees[0]['value'],
                //     "kode_unik" => $kode_unik,
                //     "is_used" => 0,
                //     'created_at' => Carbon::now()->timezone('Asia/Makassar'),
                // ]);

                // DetailTransactionHealthBeauty::create([
                //     "transaction_id" => $storeTransaction->id,
                //     "clinic_id" => $package['clinic_id'],
                //     "clinic_package_id" => $package['id'],
                //     "category" => $package['clinic']['category'] ?? 'Deleted clinic',
                //     "booking_id" => Str::random(6),
                //     "expire_on" => $expire,
                //     "rent_price" => $package->price,
                //     "fee_admin" => $fees[0]['value'],
                //     "kode_unik" => $kode_unik,
                //     "is_used" => 0,
                // ]);


            } catch (Throwable $e) {
                return response()->json([
                    'status' => 'Error Store Data Transaction',
                    'massage' => $e
                ]);
            }
        });

        return redirect()->away($payoutsXendit['invoice_url']);

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }
}

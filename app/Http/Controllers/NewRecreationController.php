<?php

namespace App\Http\Controllers;

use App\Models\CategoryRecreation;
use App\Models\Country;
use App\Models\detailTransactionRecreation;
use App\Models\Fee;
use App\Models\Recreation;
use App\Models\RecreationPackages;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class NewRecreationController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function index()
    {
        $special_deals = RecreationPackages::with('category', 'recreation')->whereColumn('price', '<', 'unit_price')->limit(10)->get();

        $categories = CategoryRecreation::select('id', 'name')->get()->toArray();

        $categorises = [];

        if(count($categories) > 0){
            foreach ($categories as $key => $rec) {
                $item = [
                        'id' => $rec['id'],
                        'name' => $rec['name'],
                    ];

                array_push($categorises, $item);
            }
        }

        $data_partners = Recreation::Active()->with('reviews', 'kota')
            ->limit(10)
            ->get();

        $partners = [];

        foreach ($data_partners as $key => $rec) {
                $item = [
                    'id' => $rec['id'],
                    'img' => asset('storage/' . $rec['image']['image'] ?? 'health_default.png'),
                    'lokasi' => $rec['kota']['city_name'] ?? 'Kota dihapus',
                    'name' => $rec['clinic_name'],
                    'rate' => $rec->avgRating(),
                    'category' => $rec['category'],
                    // 'origin_price' => (int)$rec['packages'][0]['unit_price'],
                    'origin_price' => $rec['recreationPackages'][0]['unit_price'],
                    'cut_price' => $rec['recreationPackages'][0]['price'],
                    'rating_count' => count($rec['reviews']),
                ];

                array_push($partners, $item);
        }

        $data['special_deals'] = collect($special_deals);
        $data['categorises'] = collect($categorises);
        $data['partners'] = collect($partners);
        return view('pagesv2.rekreasi.index', $data);
    }

    public function category($id){
        if($id !== 'all'){
            $data['packages'] = RecreationPackages::with('category')->where('category_recreation_id', $id)->get();
            $data['category'] = CategoryRecreation::find($id);

            return view('pagesv2.rekreasi.category', $data);
        }else{
            $data['categories'] = CategoryRecreation::get();

            return view('pagesv2.rekreasi.all_category', $data);
        }
    }

    public function show(Request $request){
        $data['date'] = $request->date;
        $data['section_title'] = $request->lokasi;
        $loc = '%'.$request->lokasi.'%';

        $data['packages'] = RecreationPackages::where(function($q) use($loc){
            $q->whereHas('recreation', function($r)use($loc){
                $r->whereHas('kota', function($k)use($loc){
                    $k->where('city_name', 'like', $loc);
                });
            });
        })
        ->get();

        return view('pagesv2.rekreasi.show', $data);
    }
  
    public function detail(Request $request, $id, $date){
        $data['detail'] = Recreation::with('reviews', 'recreationPackages', 'kota')->find($id);
        $data['date'] = $date;

        return view('pagesv2.rekreasi.detail', $data);
    }

    public function request_transaction(Request $request){

        if(!Auth::user()){
            return redirect()->route('login');
        }

        $data = $request->all();

        $package = RecreationPackages::find($data['package_id']);

        $now =  date('Y-m-d');

        if (strTolower($package['expiry_type']) == 'hari') {
            $expire = Carbon::parse($data['book_date'])->addDays($package['expiry_date'])->addHours(23)->format('Y-m-d H:i:s');
        } else {
            $expire = Carbon::now()->addHours($package['expiry_date'])->format('Y-m-d H:i:s');
        }

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('recreation') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return redirect()->back()->with('error', 'service not found');
        }

        $setting = new Setting();
        $amount = $package->price * $data['total_ticket'];

        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $amount);



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
                    'name' => $package['name'] ?? 'Invalid recreation',
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
                'req_id' => 'REC-' . time(),
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
                $point->deductPoint($request->user()->id, $saldoPointCustomer, $storeTransaction->id);
            }

                detailTransactionRecreation::create([
                    "transaction_id" => $storeTransaction->id,
                    "recreation_id" => $package['recreation_id'],
                    "recreationPackage_id" => $package['id'],
                    "booking_id" => \Illuminate\Support\Str::random(6),
                    "expire_on" => $expire,
                    "rent_price" => $package->price,
                    "fee_admin" => $fees[0]['value'],
                    "kode_unik" => $kode_unik,
                    "is_used" => 0,
                    "total_ticket" => $data['total_ticket'],
                    "book_date" => $data['book_date'],
                    "customer_name" => $data['sapa_pengunjung'] .' '. $data['nama_pengunjung'],
                    "customer_phone" => $data['phone_pengunjung'],
                    "customer_email" => $data['email_pengunjung'],
                    "customer_country" => $data['kewarganegaraan_pengunjung'],
                ]);
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return redirect()->away($payoutsXendit['invoice_url']);
    }
  
    public function order(Request $request){
        if(Auth::user()){
            $data = $request->all();
            $data['user'] =  Auth::user();
            $data['section_title'] =  'recreation';
            $data['package'] = RecreationPackages::find($data['package_id']);
            $data['service_id'] = Service::where('name', $data['service'])->first()['id'];
            $data['country'] = Country::get();
            return view('pagesv2.rekreasi.order', $data);
        }else{
            return redirect()->route('login');
        }
    }
}

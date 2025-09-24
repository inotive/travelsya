<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CarRentalHasCars;
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

    public function search_ajax(request $request){
        $find = '%' . $request->name . '%';

        $clinics = ClinicHasPackages::with('clinic')->whereHas('clinic', function($q) use($find) {
            $q->where('clinic_name', 'like', $find);
        })->get();

        $date = Carbon::now()->format('d-m-Y H:i');

        $result = null;
        foreach ($clinics as $key => $clinic) {
            $img = isset($clinic->image) && isset($clinic->image->image) ? asset($clinic->image->image) : asset('images/placeholder.jpg');
            $result = $result . '<a href="' .
                                    route('health_beauty.detail', [
                                        'lokasi' => ($clinic->clinic->kota->city_name ?? '-'),
                                        'clinic' => $clinic->clinic, 'id' => $clinic->clinic_id]
                                        )


                                    .'" class="d-flex w-100 flex-stack">

                                    <img src="' . $img .'" class="me-4 w-50px" style="border-radius: 4px" alt="">

                                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">

                                        <div class="flex-grow-1 me-2">

                                            <span  class="text-gray-800 text-hover-primary fs-6 fw-bold text-capitalize">'
                                                . ($clinic->name) .
                                            '</span>

                                            <span class="text-muted fw-semibold d-block fs-7">
                                                ' . $clinic->clinic->clinic_name . ' - ' . ($clinic->clinic->kota->city_name ?? '-') .'
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <hr>' ;
        }

        return $result;
    }

    public function category($id){
        if($id !== 'all'){
            $data['packages'] = ClinicHasPackages::with('categoriesService')->where('categories_services_id', $id)->get();
            $data['category'] = CategoriesServices::find($id);

            return view('pagesv2.health_beauty.category', $data);
        }else{
            $data['categories'] = CategoriesServices::get();

            return view('pagesv2.health_beauty.all_category', $data);
        }
    }
    public function index()
    {
        $special_deals = ClinicHasPackages::with(['clinic.kota', 'image'])->where(function($q){
            $q->whereHas('clinic', function($c){
                $c->where('category', 'kesehatan')
                ->Active();
            })
            ->whereColumn('unit_price', '>' ,'price');
        })
        ->limit(10)
        ->get();

        $special_deals_beauty = ClinicHasPackages::with(['clinic.kota', 'image'])->where(function($q){
            $q->whereHas('clinic', function($c){
                $c->where('category', 'kecantikan')
                ->Active();
            })
            ->whereColumn('unit_price', '>' ,'price');
        })
        ->limit(10)
        ->get();

        $categories = CategoriesServices::get();

        $partners = Clinic::with(['packages', 'images', 'image', 'kota'])->orderBy('created_at', 'desc')->get();

        $data['special_deals'] = collect($special_deals);
        $data['special_deals_beauty'] = collect($special_deals_beauty);
        $data['categorises'] = collect($categories);
        $data['partners'] = collect($partners);

        return view('pagesv2.health_beauty.index', $data);
    }

    public function show_special_deals(){

        $special = ClinicHasPackages::with('image', 'clinic')->whereHas('clinic', function($c){
            $c->Active();
        })->whereColumn('unit_price', '>' ,'price')->get();

        $data['special_deals'] = $special;

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

    public function show_mitra(){
        $data['mitra'] = Clinic::Active()->with(['image', 'kota', 'packages'])->get();

        return view('pagesv2.health_beauty.all_mitra', $data);
    }

    public function search(Request $request){
        $city = '%' . $request->location . '%';
        $data['clinics'] = Clinic::Active()->with('reviews', 'packages', 'kota')
//            ->where('category', 'kesehatan')
//            ->whereHas('packages', function ($p) {
//                $p->whereColumn('unit_price', '>', 'price');
//            })
            ->when($city, function ($c, $cit) {
                $c->whereHas('kota', function ($k) use ($cit) {
                    $k->where('city_name', 'like', $cit);
                });
            })
            ->get();
//        DD($data);
        $data['section_title'] = strToUpper($request->location);

        return view('pagesv2.health_beauty.show', $data);
    }

    public function detail(Request $request, $lokasi = null, $clinic, $id = null){
        if($id){
            $data['clinic'] = Clinic::with('reviews', 'kota', 'packages.image', 'packages.facility.facility', 'images')->find($id);
        }else{
            $data['clinic'] = null;
        }

        return view('pagesv2.health_beauty.detail', $data);
    }

    public function order(Request $request){
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
                "customer_name" => $data['sapa_pengunjung'] .' '. $data['nama_pengunjung'],
                "customer_phone" => $data['phone_pengunjung'],
                "customer_email" => $data['email_pengunjung'],
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

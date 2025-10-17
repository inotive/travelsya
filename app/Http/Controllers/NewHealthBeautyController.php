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
    
    /**
     * Map category string to integer ID
     * 
     * @param string $category
     * @return int
     */
    private function mapCategoryToInteger($category)
    {
        $categoryMap = [
            'kesehatan' => 1,
            'kecantikan' => 2,
            'spa dan kecantikan' => 3,
        ];
        
        // If it's a known category, return its integer ID; otherwise return 0 for unknown
        return $categoryMap[$category] ?? 0;
    }

    public function search_ajax(Request $request){
        $find = '%' . $request->name . '%';

        $clinics = ClinicHasPackages::with('clinic.kota')
            ->where(function($query) use($find) {
                $query->whereHas('clinic', function($q) use($find) {
                    // Cari berdasarkan nama klinik
                    $q->where('clinic_name', 'like', $find);
                })
                ->orWhere('name', 'like', $find) // Cari berdasarkan nama paket
                ->orWhereHas('clinic.kota', function($q) use($find) {
                    // Cari berdasarkan nama kota
                    $q->where('city_name', 'like', $find);
                });
            })
            ->get();

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
        // Ambil data khusus untuk kesehatan dan kecantikan secara terpisah
        $special_deals_all_health = ClinicHasPackages::with(['clinic.kota', 'clinic'])
            ->whereHas('clinic', function($q) {
                $q->Active();
            })
            ->whereColumn('unit_price', '>' ,'price')
            ->limit(20)
            ->get();

        $special_deals_all_beauty = clone $special_deals_all_health;

        // Filter data untuk kesehatan
        $special_deals_health = $special_deals_all_health->filter(function($deal) {
            return $deal->clinic && strtolower(trim($deal->clinic->category)) === 'kesehatan';
        })->take(10);

        // Filter data untuk kecantikan
        $special_deals_beauty = $special_deals_all_beauty->filter(function($deal) {
            return $deal->clinic && strtolower(trim($deal->clinic->category)) === 'kecantikan';
        })->take(10);

        // Debug: log kategori yang ditemukan
        foreach($special_deals_all_health as $deal) {
            if($deal->clinic) {
                \Log::info('Package: ' . $deal->name . ' - Clinic Category: ' . $deal->clinic->category);
            }
        }

        // Jika tidak ada penawaran khusus untuk kesehatan, tampilkan semua paket dari klinik kesehatan
        if ($special_deals_health->isEmpty()) {
            $special_deals_health = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($q) {
                    $q->Active();
                    $q->where(function($subq) {
                        $subq->where('category', 'kesehatan')
                             ->orWhere('category', 'Kesehatan')
                             ->orWhere('category', 'KESEHATAN');
                    });
                })
                ->limit(10)
                ->get();
        }
        
        // Jika tidak ada penawaran khusus untuk kecantikan, tampilkan semua paket dari klinik kecantikan
        if ($special_deals_beauty->isEmpty()) {
            $special_deals_beauty = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($q) {
                    $q->Active();
                    $q->where(function($subq) {
                        $subq->where('category', 'kecantikan')
                             ->orWhere('category', 'Kecantikan')
                             ->orWhere('category', 'KECANTIKAN');
                    });
                })
                ->limit(10)
                ->get();
        }
        
        // Data untuk tab spa dan kecantikan - ambil dari semua data klinik
        $special_deals_spa_beauty = ClinicHasPackages::with(['clinic.kota', 'clinic'])
            ->whereHas('clinic', function($q) {
                $q->Active();
            })
            ->whereColumn('unit_price', '>' ,'price')
            ->get()
            ->filter(function($deal) {
                return $deal->clinic && in_array(strtolower(trim($deal->clinic->category)), ['spa', 'salon', 'spa dan kecantikan']);
            })->take(10);

        // Jika tidak ada penawaran khusus untuk spa dan kecantikan, tampilkan semua paket dari klinik spa/kecantikan
        if ($special_deals_spa_beauty->isEmpty()) {
            $special_deals_spa_beauty = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($q) {
                    $q->Active();
                    $q->where(function($subq) {
                        $subq->where('category', 'spa')
                             ->orWhere('category', 'SPA')
                             ->orWhere('category', 'Salon')
                             ->orWhere('category', 'salon')
                             ->orWhere('category', 'spa dan kecantikan')
                             ->orWhere('category', 'Spa Dan Kecantikan')
                             ->orWhere('category', 'SPA DAN KECANTIKAN');
                    });
                })
                ->limit(10)
                ->get();
        }

        // Lakukan filter tambahan untuk memastikan hanya kategori tertentu yang ditampilkan
        $special_deals_health = $special_deals_health->filter(function($deal) {
            return $deal->clinic && in_array(strtolower(trim($deal->clinic->category)), ['kesehatan', 'health']);
        })->take(10);

        $special_deals_beauty = $special_deals_beauty->filter(function($deal) {
            return $deal->clinic && in_array(strtolower(trim($deal->clinic->category)), ['kecantikan', 'beauty']);
        })->take(10);

        $special_deals_spa_beauty = $special_deals_spa_beauty->filter(function($deal) {
            return $deal->clinic && in_array(strtolower(trim($deal->clinic->category)), ['spa', 'salon', 'spa dan kecantikan']);
        })->take(10);

        $all_categories = CategoriesServices::whereNotIn('name', ['Product', 'Threadlift', 'Peeling', 'Injection', 'Service'])->get();
        
        // Pisahkan kategori berdasarkan tipe untuk tab beauty
        $beauty_service_keywords = ['injection', 'threadlift', 'peeling', 'treatment', 'facial', 'skin care', 'acne', 'anti aging'];
        $service_categories = collect();
        $product_categories = collect();
        $health_categories = collect();
        
        foreach ($all_categories as $category) {
            $category_name_lower = strtolower($category->name);
            $clinic_packages = $category->clinicHasPackages()->with(['clinic'])->get();
            
            // Cek apakah kategori terkait dengan klinik kecantikan
            $is_beauty = $clinic_packages->contains(function($package) {
                return $package->clinic && in_array(strtolower(trim($package->clinic->category)), ['kecantikan', 'beauty']);
            });
            
            if ($is_beauty) {
                // Cek apakah termasuk service berdasarkan kata kunci
                $is_service = false;
                foreach ($beauty_service_keywords as $keyword) {
                    if (str_contains($category_name_lower, $keyword)) {
                        $is_service = true;
                        break;
                    }
                }
                
                if ($is_service) {
                    $service_categories->push($category);
                } else {
                    $product_categories->push($category);
                }
            } else {
                // Kategori untuk kesehatan
                $health_categories->push($category);
            }
        }

        $partners = Clinic::with(['packages', 'images', 'image', 'kota'])->orderBy('created_at', 'desc')->get();

        // Debug: tambahkan count untuk melihat berapa banyak data
        \Log::info('Special Deals Health Count: ' . $special_deals_health->count());
        \Log::info('Special Deals Beauty Count: ' . $special_deals_beauty->count());

        $data['special_deals'] = $special_deals_health;
        $data['special_deals_beauty'] = $special_deals_beauty;
        $data['special_deals_spa_beauty'] = $special_deals_spa_beauty;
        $data['categorises'] = collect($all_categories);  // untuk tab kesehatan
        $data['service_categories'] = $service_categories;
        $data['product_categories'] = $product_categories;
        $data['partners'] = collect($partners);

        return view('pagesv2.health_beauty.index', $data);
    }

    public function show_special_deals($category = 'health'){

        // Menentukan kategori berdasarkan parameter
        if (strtolower($category) === 'beauty' || strtolower($category) === 'kecantikan') {
            // Untuk kecantikan
            $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'kecantikan')
                             ->orWhere('category', 'Kecantikan')
                             ->orWhere('category', 'KECANTIKAN')
                             ->orWhere('category', 'beauty')
                             ->orWhere('category', 'Beauty')
                             ->orWhere('category', 'BEAUTY');
                    });
                })
                ->whereColumn('unit_price', '>' ,'price')
                ->get();

            // Jika tidak ada penawaran khusus untuk kecantikan, tampilkan semua paket dari klinik kecantikan
            if ($special->isEmpty()) {
                $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'kecantikan')
                                 ->orWhere('category', 'Kecantikan')
                                 ->orWhere('category', 'KECANTIKAN')
                                 ->orWhere('category', 'beauty')
                                 ->orWhere('category', 'Beauty')
                                 ->orWhere('category', 'BEAUTY');
                        });
                    })
                    ->get();
            }
        } elseif (strtolower($category) === 'spa_beauty' || strtolower($category) === 'spa' || strtolower($category) === 'salon' || strtolower($category) === 'spa dan kecantikan') {
            // Untuk spa dan kecantikan
            $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'spa')
                             ->orWhere('category', 'SPA')
                             ->orWhere('category', 'Salon')
                             ->orWhere('category', 'salon')
                             ->orWhere('category', 'spa dan kecantikan')
                             ->orWhere('category', 'Spa Dan Kecantikan')
                             ->orWhere('category', 'SPA DAN KECANTIKAN');
                    });
                })
                ->whereColumn('unit_price', '>' ,'price')
                ->get();

            // Jika tidak ada penawaran khusus untuk spa dan kecantikan, tampilkan semua paket dari klinik spa/kecantikan
            if ($special->isEmpty()) {
                $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'spa')
                                 ->orWhere('category', 'SPA')
                                 ->orWhere('category', 'Salon')
                                 ->orWhere('category', 'salon')
                                 ->orWhere('category', 'spa dan kecantikan')
                                 ->orWhere('category', 'Spa Dan Kecantikan')
                                 ->orWhere('category', 'SPA DAN KECANTIKAN');
                        });
                    })
                    ->get();
            }
        } else {
            // Untuk kesehatan (default)
            $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'kesehatan')
                             ->orWhere('category', 'Kesehatan')
                             ->orWhere('category', 'KESEHATAN')
                             ->orWhere('category', 'health')
                             ->orWhere('category', 'Health')
                             ->orWhere('category', 'HEALTH');
                    });
                })
                ->whereColumn('unit_price', '>' ,'price')
                ->get();

            // Jika tidak ada penawaran khusus untuk kesehatan, tampilkan semua paket dari klinik kesehatan
            if ($special->isEmpty()) {
                $special = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'kesehatan')
                                 ->orWhere('category', 'Kesehatan')
                                 ->orWhere('category', 'KESEHATAN')
                                 ->orWhere('category', 'health')
                                 ->orWhere('category', 'Health')
                                 ->orWhere('category', 'HEALTH');
                        });
                    })
                    ->get();
            }
        }

        $data['special_deals'] = $special;
        $data['category'] = $category; // Kirim kategori ke view

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

    public function show_mitra($category = null){
        $query = Clinic::Active()->with(['image', 'kota', 'packages']);
        
        if ($category) {
            if (strtolower($category) === 'spa_beauty' || strtolower($category) === 'spa' || strtolower($category) === 'salon' || strtolower($category) === 'spa dan kecantikan') {
                // Untuk kategori spa dan kecantikan
                $query->where(function($q) {
                    $q->where('category', 'kecantikan')
                      ->orWhere('category', 'Kecantikan')
                      ->orWhere('category', 'KECANTIKAN')
                      ->orWhere('category', 'beauty')
                      ->orWhere('category', 'Beauty')
                      ->orWhere('category', 'BEAUTY')
                      ->orWhere('category', 'spa')
                      ->orWhere('category', 'SPA')
                      ->orWhere('category', 'Salon')
                      ->orWhere('category', 'salon')
                      ->orWhere('category', 'spa dan kecantikan')
                      ->orWhere('category', 'Spa Dan Kecantikan')
                      ->orWhere('category', 'SPA DAN KECANTIKAN');
                });
            } elseif (strtolower($category) === 'health' || strtolower($category) === 'kesehatan') {
                // Untuk kategori kesehatan
                $query->where(function($q) {
                    $q->where('category', 'kesehatan')
                      ->orWhere('category', 'Kesehatan')
                      ->orWhere('category', 'KESEHATAN')
                      ->orWhere('category', 'health')
                      ->orWhere('category', 'Health')
                      ->orWhere('category', 'HEALTH');
                });
            } elseif (strtolower($category) === 'beauty' || strtolower($category) === 'kecantikan') {
                // Untuk kategori kecantikan
                $query->where(function($q) {
                    $q->where('category', 'kecantikan')
                      ->orWhere('category', 'Kecantikan')
                      ->orWhere('category', 'KECANTIKAN')
                      ->orWhere('category', 'beauty')
                      ->orWhere('category', 'Beauty')
                      ->orWhere('category', 'BEAUTY');
                });
            }
        }
        
        $data['mitra'] = $query->get();
        $data['category'] = $category;

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

            // Map category string to integer ID for database storage
            $categoryValue = $package['clinic']['category'] ?? 'Deleted clinic';
            $categoryInt = $this->mapCategoryToInteger($categoryValue);
            
            DetailTransactionHealthBeauty::create([
                "transaction_id" => $storeTransaction->id,
                "clinic_id" => $package['clinic_id'],
                "clinic_package_id" => $package['id'],
                "category" => $categoryInt,
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

    public function search_special_deals(Request $request){
        $search = $request->input('search');
        $category = $request->input('category', 'health'); // Default ke health

        if (strtolower($category) === 'beauty' || strtolower($category) === 'kecantikan') {
            // Untuk kecantikan
            $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'kecantikan')
                             ->orWhere('category', 'Kecantikan')
                             ->orWhere('category', 'KECANTIKAN')
                             ->orWhere('category', 'beauty')
                             ->orWhere('category', 'Beauty')
                             ->orWhere('category', 'BEAUTY');
                    });
                });

            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                          $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                      });
                });
            } else {
                // Jika pencarian kosong, tampilkan semua penawaran khusus dari klinik kecantikan
                $query->whereColumn('unit_price', '>' ,'price');
            }

            $special_deals = $query->get();

            // Jika tidak ada penawaran khusus yang cocok dengan pencarian, tampilkan semua paket dari klinik kecantikan
            if ($special_deals->isEmpty() && !empty($search)) {
                $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'kecantikan')
                                 ->orWhere('category', 'Kecantikan')
                                 ->orWhere('category', 'KECANTIKAN')
                                 ->orWhere('category', 'beauty')
                                 ->orWhere('category', 'Beauty')
                                 ->orWhere('category', 'BEAUTY');
                        });
                    });

                if (!empty($search)) {
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                          ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                              $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                          });
                    });
                }

                $special_deals = $query->get();
            }
        } elseif (strtolower($category) === 'spa_beauty' || strtolower($category) === 'spa' || strtolower($category) === 'salon' || strtolower($category) === 'spa dan kecantikan') {
            // Untuk spa dan kecantikan
            $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'kecantikan')
                             ->orWhere('category', 'Kecantikan')
                             ->orWhere('category', 'KECANTIKAN')
                             ->orWhere('category', 'beauty')
                             ->orWhere('category', 'Beauty')
                             ->orWhere('category', 'BEAUTY')
                             ->orWhere('category', 'spa')
                             ->orWhere('category', 'SPA')
                             ->orWhere('category', 'Salon')
                             ->orWhere('category', 'salon')
                             ->orWhere('category', 'spa dan kecantikan')
                             ->orWhere('category', 'Spa Dan Kecantikan')
                             ->orWhere('category', 'SPA DAN KECANTIKAN');
                    });
                });

            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                          $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                      });
                });
            } else {
                // Jika pencarian kosong, tampilkan semua penawaran khusus dari klinik spa/kecantikan
                $query->whereColumn('unit_price', '>' ,'price');
            }

            $special_deals = $query->get();

            // Jika tidak ada penawaran khusus yang cocok dengan pencarian, tampilkan semua paket dari klinik spa/kecantikan
            if ($special_deals->isEmpty() && !empty($search)) {
                $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'spa')
                                 ->orWhere('category', 'SPA')
                                 ->orWhere('category', 'Salon')
                                 ->orWhere('category', 'salon')
                                 ->orWhere('category', 'spa dan kecantikan')
                                 ->orWhere('category', 'Spa Dan Kecantikan')
                                 ->orWhere('category', 'SPA DAN KECANTIKAN');
                        });
                    });

                if (!empty($search)) {
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                          ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                              $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                          });
                    });
                }

                $special_deals = $query->get();
            }
        } else {
            // Untuk kesehatan (default)
            $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                ->whereHas('clinic', function($c){
                    $c->Active();
                    $c->where(function($subq) {
                        $subq->where('category', 'kesehatan')
                             ->orWhere('category', 'Kesehatan')
                             ->orWhere('category', 'KESEHATAN')
                             ->orWhere('category', 'health')
                             ->orWhere('category', 'Health')
                             ->orWhere('category', 'HEALTH');
                    });
                });

            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                          $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                      });
                });
            } else {
                // Jika pencarian kosong, tampilkan semua penawaran khusus dari klinik kesehatan
                $query->whereColumn('unit_price', '>' ,'price');
            }

            $special_deals = $query->get();

            // Jika tidak ada penawaran khusus yang cocok dengan pencarian, tampilkan semua paket dari klinik kesehatan
            if ($special_deals->isEmpty() && !empty($search)) {
                $query = ClinicHasPackages::with(['clinic.kota', 'image'])
                    ->whereHas('clinic', function($q) {
                        $q->Active();
                        $q->where(function($subq) {
                            $subq->where('category', 'kesehatan')
                                 ->orWhere('category', 'Kesehatan')
                                 ->orWhere('category', 'KESEHATAN')
                                 ->orWhere('category', 'health')
                                 ->orWhere('category', 'Health')
                                 ->orWhere('category', 'HEALTH');
                        });
                    });

                if (!empty($search)) {
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                          ->orWhereHas('clinic', function($clinicQuery) use ($search) {
                              $clinicQuery->where('clinic_name', 'LIKE', "%{$search}%");
                          });
                    });
                }

                $special_deals = $query->get();
            }
        }

        return response()->json([
            'special_deals' => $special_deals
        ]);
    }
}
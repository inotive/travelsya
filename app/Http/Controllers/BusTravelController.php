<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Helpers\ResponseFormatter;
use App\Models\BusBooked;
use App\Models\BusDeparture;
use App\Models\BusRoute;
use App\Models\BusTravels;
use App\Models\City;
use App\Models\DetailTransactionBus;
use App\Models\Fee;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusTravelController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function index()
    {
        $data['city'] = BusRoute::get()->pluck('name', 'name');

        $route = BusBooked::withCount('departure')->orderBy('departure_count', 'desc')->limit(12)->get();

        $data['route'] = $route->map(function ($r) {
            $r['from'] = $r->departure->from->name ?? '-';
            $r['to'] = $r->departure->to->name ?? '-';

            return $r;
        });

        $route_travel = BusBooked::withCount('departure')->orderBy('departure_count', 'desc')->limit(12)->get();

        $data['route_travel'] = $route_travel->map(function ($r) {
            $r['from'] = $r->departure->from->name ?? '-';
            $r['to'] = $r->departure->to->name ?? '-';

            return $r;
        });

        $data['popular'] = BusTravels::withCount('booked')->orderBy('booked_count', 'desc')->limit(8)->get();

        return view('pagesv2.bus_travel.index', $data);
    }

    public function search(Request $request, $agent = null)
    {
        $from = '%' . $request->kota_awal . '%';
        $to = '%' . $request->kota_tujuan . '%';
        $date = $request->date_pergi ?? now()->format('Y-m-d');
        $date_pulang = $request->date_pulang ?? null;
        $qty = $request->jumlah_penumpang ? $request->jumlah_penumpang : 1;
        $pp = $request->is_pulang_pergi ?? 0;
        $selected_agent = $request->agent ? '%' . $request->agent . '%' : null;

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
            })
            ->when($selected_agent, function ($q, $a) {
                $q->whereHas('busTravel', function ($b) use ($a) {
                    $b->whereHas('busTravel', function ($b2) use ($a) {
                        $b2->where('business_name', 'like', $a);
                    });
                });
            })
            ->get();

        $pulang = [];

        if ((int)$pp == 1) {
            $pulang = BusDeparture::with('busTravel', 'from', 'to')
                ->has('busTravel')
                ->whereHas('to', function ($f) use ($from) {
                    $f->where('name', 'like', $from);
                })
                ->whereHas('from', function ($t) use ($to) {
                    $t->where('name', 'like', $to);
                })
                ->when($selected_agent, function ($q, $a) {
                    $q->whereHas('busTravel', function ($b) use ($a) {
                        $b->whereHas('busTravel', function ($b2) use ($a) {
                            $b2->where('business_name', 'like', $a);
                        });
                    });
                })
                ->get();
        }

        $newData['agent'] = BusTravels::Active()->get();
        $newData['selected_agent'] = $request->agent ?? null;

        $newData['is_pulang_pergi'] = $pp;
        $newData['kota_awal'] = $request->kota_awal;
        $newData['kota_tujuan'] = $request->kota_tujuan;
        $newData['date_pergi'] = $request->date_pergi;
        $newData['date_pulang'] = $request->date_pulang;
        $newData['jumlah_penumpang'] = $qty;
        $newData['pergi'] = $this->formatBus($pergi, $date);
        $newData['pulang'] = $this->formatBus($pulang, $date_pulang);
        $newData['city'] = BusRoute::get()->pluck('name', 'name');

        return view('pagesv2.bus_travel.search_result', $newData);
    }

    public function findByRoute($kota_awal, $kota_tujuan)
    {
        $from = '%' . $kota_awal . '%';
        $to = '%' . $kota_tujuan . '%';
        $date = now()->format('Y-m-d');
        $date_pulang = $request->date_pulang ?? null;
        $qty = 1;
        $pp = 0;
        $selected_agent = null;

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
            })
            ->when($selected_agent, function ($q, $a) {
                $q->whereHas('busTravel', function ($b) use ($a) {
                    $b->whereHas('busTravel', function ($b2) use ($a) {
                        $b2->where('business_name', 'like', $a);
                    });
                });
            })
            ->get();

        $pulang = [];

        if ((int)$pp == 1) {
            $pulang = BusDeparture::with('busTravel', 'from', 'to')
                ->has('busTravel')
                ->whereHas('to', function ($f) use ($from) {
                    $f->where('name', 'like', $from);
                })
                ->whereHas('from', function ($t) use ($to) {
                    $t->where('name', 'like', $to);
                })
                ->when($selected_agent, function ($q, $a) {
                    $q->whereHas('busTravel', function ($b) use ($a) {
                        $b->whereHas('busTravel', function ($b2) use ($a) {
                            $b2->where('business_name', 'like', $a);
                        });
                    });
                })
                ->get();
        }

        $newData['agent'] = BusTravels::Active()->get();
        $newData['selected_agent'] = $request->agent ?? null;

        $newData['is_pulang_pergi'] = $pp;
        $newData['kota_awal'] = $kota_awal;
        $newData['kota_tujuan'] = $kota_tujuan;
        $newData['date_pergi'] = $date;
        $newData['date_pulang'] = null;
        $newData['jumlah_penumpang'] = $qty;
        $newData['pergi'] = $this->formatBus($pergi, $date);
        $newData['pulang'] = $this->formatBus($pulang, $date_pulang);
        $newData['city'] = BusRoute::get()->pluck('name', 'name');

        return view('pagesv2.bus_travel.search_result', $newData);
    }

    public function formatSingleBus($collection, $date = null)
    {
        $available = General::busAvailableTicket($collection, $date);
        $item = [
            'id' => $collection['id'],
            'business_name' => $collection['busTravel']['busTravel']['business_name'] ?? 'Deleted business',
            'class' => $collection['busTravel']['class'],
            'departure_point' => $collection['from']['name'] ?? 'Deleted point',
            'departure_time' => Carbon::parse($collection['departure_time'])->format('H:i'),
            'arrival_point' => $collection['to']['name'] ?? 'Deleted point',
            'arrival_time' => Carbon::parse($collection['departure_time'])->addHours($collection['duration'] ?? 1)->format('H:i'),
            'price' => $collection['price'],
            // 'available_tickets' => $collection['busTravel']['number_seats'] ?? 0,
            'available_tickets' => $available,
        ];

        return $item;
    }

    public function formatBus($collections, $date = null)
    {
        $newTicket = [];

        foreach ($collections as $key => $val) {
            $available = General::busAvailableTicket($val, $date);
            $item = [
                'id' => $val['id'],
                'business_name' => $val['busTravel']['busTravel']['business_name'] ?? 'Deleted business',
                'name' => $val['busTravel']['name'] ?? 'Deleted business',
                'class' => $val['busTravel']['class'],
                'departure_point' => $val['from']['name'] ?? 'Deleted point',
                'departure_time' => Carbon::parse($val['departure_time'])->format('H:i'),
                'arrival_point' => $val['to']['name'] ?? 'Deleted point',
                'arrival_time' => Carbon::parse($val['departure_time'])->addHours($val['duration'] ?? 1)->format('H:i'),
                'price' => $val['price'],
                'duration' => $val['duration'],
                'avgRating' => $val->busTravel->avgRating(),
                'reviews' => $val->busTravel->reviews,
                // 'available_tickets' => $val['busTravel']['number_seats'] ?? 0,
                'available_tickets' => $available,
            ];

            array_push($newTicket, $item);
        }

        return $newTicket;
    }

    public function detail(Request $request, $departure_id, $kota_awal, $kota_tujuan, $is_pulang_pergi, $jumlah_penumpang, $date_pergi, $date_pulang = null)
    {
        $param = $request;

        $data['departure_id'] = $departure_id;
        $data['kota_awal'] = $kota_awal;
        $data['kota_tujuan'] = $kota_tujuan;
        $data['is_pulang_pergi'] = $is_pulang_pergi;
        $data['jumlah_penumpang'] = $jumlah_penumpang;
        $data['date_pergi'] = $date_pergi;
        $data['date_pulang'] = $date_pulang;

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);
        // dd($data['departure']->busTravel->number_seats%2);
        // dd($data);

        return view('pagesv2.bus_travel.detail', $data);
    }

    public function order(Request $request)
    {
        // dd($request);
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }
        $param = $request;

        $data['is_pulang_pergi'] = $param['is_pulang_pergi'];
        $data['departure_id'] = $param['departure_id'];
        $data['kota_awal'] = $param['kota_awal'];
        $data['kota_tujuan'] = $param['kota_tujuan'];
        $data['jumlah_penumpang'] = $param['jumlah_penumpang'];
        $data['date_pergi'] = $param['date_pergi'];
        $data['date_pulang'] = $param['date_pulang'];
        for ($i=1; $i <= $param['jumlah_penumpang']; $i++) { 
            $data['kursi_penumpang_'.$i] = $param['kursi_penumpang_'.$i];
        }

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);
        $data['user'] = $user;

        $service = Service::where('name', 'bus-travel')->first();

        $data['service_id'] = $service->id;

        // dd($data);

        return view('pagesv2.bus_travel.order', $data);
    }

    public function request_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'payment' => 'required|string',
            'ticket_pergi_id' => 'required',
            'point' => 'required',
            'date_pergi' => 'required|date',
            'jumlah_penumpang' => 'required|integer',
            'is_pulang_pergi' => 'required',
            'is_same' => 'required',
        ]);

        if ((int)$request->is_same == 0) {
            $validator = Validator::make($request->all(), [
                'customer_call_1' => 'required',
                'customer_name_1' => 'required',
                'customer_phone_1' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Bus Travel process failed',
                    500,
                );
            }

            $customer = [
                'name' => $request->customer_call_1 . ' ' . $request->customer_name_1,
                'phone' => $request->customer_phone_1,
                'email' => $request->customer_email_1,
            ];
        } else {
            $customer = [
                'name' => Auth::user()->name,
                'phone' => Auth::user()->phone ?? '000000000000',
                'email' => Auth::user()->email,
            ];
        }

        $data = $request->all();

        $pulang = [];

        $total = 0;

        if ((int) $data['is_pulang_pergi'] == 1) {
            $validator = Validator::make($request->all(), [
                'date_pulang' => 'required|date',
                'ticket_pulang_id' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            $pulang = BusDeparture::with('busTravel', 'from', 'to')->find($data['ticket_pulang_id']);

            if (!$pulang) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Paket tiket pergi tidak ditemukan ',
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            $dateTimePulang = $data['date_pulang'] . ' ' . $pulang['departure_time'];

            $berangkatPulang =  Carbon::parse($dateTimePulang)->format('Y-m-d H:i');

            $total += $pulang['price'];
        } else {
            $berangkatPulang = null;
        }

        $data = $request->all();

        $pergi = BusDeparture::with('busTravel', 'from', 'to')->find($data['ticket_pergi_id']);
        $dateTimePergi = $data['date_pergi'] . ' ' . $pergi['departure_time'];

        $berangkat =  Carbon::parse($dateTimePergi)->format('Y-m-d H:i');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('bus_travel') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $pergi->price);

        $kali = (int)$data['is_pulang_pergi'] == 1 ? 2 : 1;

        $total += $pergi['price'];


        $amount = $total * $data['jumlah_penumpang'];

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
            $saldoPointCustomer = Auth::user()->point;
            $fees = [
                [
                    'type' => 'Point',
                    'value' => $saldoPointCustomer,
                ],
            ];
        }

        $business = $pergi['busTravel']['busTravel']['business_name'] ?? 'Deleted business';

        $title = 'Pembelian ticket ' . $business . ((int)$data['is_pulang_pergi'] == 1 ? ' Pulang Pergi ' : ' ') . $pergi['from']['name'] . ' - ' . $pergi['to']['name'] . ' untuk tanggal ' . $berangkat;

        // Create xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $data['ticket_pergi_id'],
                    'name' => $title,
                    'price' => $amount, // tanpa pajak
                    'quantity' => $data['jumlah_penumpang'] * $kali,
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $kode_unik, // include pajak
            'success_redirect_url' => route('user.orderHistory'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $customer['name'],
                'email' => $customer['email'],
                'mobile_number' => $customer['phone'],
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $berangkat, $berangkatPulang, $customer, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $pergi, $pulang, $saldoPointCustomer) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'BNT-' . time(),
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

            $booking_id = \Illuminate\Support\Str::random(6);

            for ($i = 1; $i <= $data['jumlah_penumpang']; $i++) {

                DetailTransactionBus::create([
                    "transaction_id" => $storeTransaction->id,
                    "bus_travel_id" => $pergi['busTravel']['busTravel']['id'],
                    "bus_travel_has_bus_id" => $pergi['busTravel']['id'],
                    "bus_departure_id" => $pergi['id'],
                    "booking_id" => $booking_id,
                    "departure_time" => $berangkat,
                    "from" => $pergi['from']['name'],
                    "to" => $pergi['to']['name'],
                    "price" => $pergi['price'],
                    "fee_admin" => $fees[0]['value'] / $data['jumlah_penumpang'],
                    "kode_unik" => $kode_unik,
                    "customer_name" => $request['customer_call_'.$i].' '.$request['customer_name_'.$i] ?? '-',
                    "customer_phone" => $request['customer_phone_'.$i] ?? '-',
                    "customer_email" => $request['customer_email_'.$i] ?? '-',
                ]);

                if ((int)$data['is_pulang_pergi'] == 1) {
                    DetailTransactionBus::create([
                        "transaction_id" => $storeTransaction->id,
                        "bus_travel_id" => $pulang['busTravel']['busTravel']['id'],
                        "bus_travel_has_bus_id" => $pulang['busTravel']['id'],
                        "bus_departure_id" => $pulang['id'],
                        "booking_id" => $booking_id,
                        "departure_time" => $berangkatPulang,
                        "from" => $pulang['from']['name'],
                        "to" => $pulang['to']['name'],
                        "price" => $pulang['price'],
                        "fee_admin" => 0,
                        // "duration" => $data['duration'],
                        "kode_unik" => $kode_unik,
                        "customer_name" => $request['customer_call_'.$i].' '.$request['customer_name_'.$i] ?? '-',
                        "customer_phone" => $request['customer_phone_'.$i] ?? '-',
                        "customer_email" => $request['customer_email_'.$i] ?? '-',
                    ]);
                }
            }
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
        return redirect()->away($payoutsXendit['invoice_url']);
    }
}

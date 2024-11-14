<?php

namespace App\Http\Controllers\API;

use App\Helpers\General;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BusDeparture;
use App\Models\BusTravelHasBus;
use App\Models\BusTravelRating;
use App\Models\BusTravels;
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

    public function detail_ticket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_inv' => 'required',
            'ticket_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Bus & Travel Ticket process failed',
                500,
            );
        }

        $detail = DetailTransactionBus::with('transaction', 'BusTravel', 'departure', 'busTravelHasBus')->find($request->ticket_id);

        return ResponseFormatter::success(
            $detail,
            'Load data success',
            20,
        );
    }

    public function postRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bintang' => 'required',
            'transaction_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Review Clinic process failed',
                500,
            );
        }

        $transaction = Transaction::with('detailTransactionBus')->find($request->transaction_id);

        if ($transaction) {
            BusTravelRating::create([
                'bus_travel_id'      => $transaction->detailTransactionBus[0]->bus_travel_id ?? 0,
                'transaction_id' => $request->transaction_id,
                'bus_travel_has_bus_id' => $transaction->detailTransactionBus[0]->bus_travel_has_bus_id ?? 0,
                'user_id'      => auth()->id(),
                'rate'          => $request->bintang,
                'comment'       => $request->review,
            ]);

            return ResponseFormatter::success([], 'Review Bus & Travel Telah Berhasil Dikirim');
        } else {
            return ResponseFormatter::error([], 'Transaksi tidak ditemukan');
        }
    }

    public function cari(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kota_awal' => 'required',
            'kota_tujuan' => 'required',
            'date_pergi' => 'required|date',
            'jumlah_penumpang' => 'required',
            'is_pulang_pergi' => 'required',
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

        if ((int)$request->is_pulang_pergi == 1) {
            $validator = Validator::make($request->all(), [
                'date_pulang' => 'required',
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
        }

        $from = '%' . $request->kota_awal . '%';
        $to = '%' . $request->kota_tujuan . '%';
        $date = $request->date_pergi;
        $date_pulang = $request->date_pulang;
        $qty = $request->jumlah_penumpang;
        $pp = $request->is_pulang_pergi;

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
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
                ->get();
        }

        $newData['is_pulang_pergi'] = $pp;
        $newData['kota_awal'] = $request->kota_awal;
        $newData['kota_tujuan'] = $request->kota_tujuan;
        $newData['date_pergi'] = $request->date;
        $newData['date_pulang'] = $request->date_pulang;
        $newData['jumlah_penumpang'] = $request->jumlah_penumpang;
        $newData['pergi'] = $this->formatBus($pergi, $date);
        $newData['pulang'] = $this->formatBus($pulang, $date_pulang);

        return ResponseFormatter::success($newData, 'Data successfully loaded');
    }

    public function formatSingleBus($collection)
    {
        $item = [
            'id' => $collection['id'],
            'business_name' => $collection['busTravel']['busTravel']['business_name'] ?? 'Deleted business',
            'class' => $collection['busTravel']['class'],
            'departure_point' => $collection['from']['name'] ?? 'Deleted point',
            'departure_time' => Carbon::parse($collection['departure_time'])->format('H:i'),
            'arrival_point' => $collection['to']['name'] ?? 'Deleted point',
            'arrival_time' => Carbon::parse($collection['departure_time'])->addHours($collection['duration'] ?? 1)->format('H:i'),
            'price' => $collection['price'],
            'available_tickets' => $collection['busTravel']['number_seats'] ?? 0,
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
                'class' => $val['busTravel']['class'],
                'departure_point' => $val['from']['name'] ?? 'Deleted point',
                'departure_time' => Carbon::parse($val['departure_time'])->format('H:i'),
                'arrival_point' => $val['to']['name'] ?? 'Deleted point',
                'arrival_time' => Carbon::parse($val['departure_time'])->addHours($val['duration'] ?? 1)->format('H:i'),
                'price' => $val['price'],
                // 'available_tickets' => $val['busTravel']['number_seats'] ?? 0,
                'available_tickets' => $available,
            ];

            array_push($newTicket, $item);
        }

        return $newTicket;
    }

    public function requestTransaction(Request $request)
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

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Bus & Travel process failed',
                500,
            );
        }

        if ((int)$request->is_same == 0) {
            $validator = Validator::make($request->all(), [
                'customer_call' => 'required',
                'customer_name' => 'required',
                'customer_phone' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Car Rental process failed',
                    500,
                );
            }

            $customer = [
                'name' => $request->customer_call . ' ' . $request->customer_name,
                'phone' => $request->customer_phone,
                'email' => $request->customer_email,
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
            'success_redirect_url' => route('redirect.succes'),
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
                "fee_admin" => $fees[0]['value'],
                "kode_unik" => $kode_unik,
                "customer_name" => $customer['name'] ?? '-',
                "customer_phone" => $customer['phone'] ?? '-',
                "customer_email" => $customer['email'] ?? '-',
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
                    "customer_name" => $customer['name'] ?? '-',
                    "customer_phone" => $customer['phone'] ?? '-',
                    "customer_email" => $customer['email'] ?? '-',
                ]);
            }
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function detail_pesanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ticket_pergi' => 'required',
            'date_pergi' => 'required|date',
            'jumlah_penumpang' => 'required',
            'is_pulang_pergi' => 'required',
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

        $data = $request->all();

        $pulang = [];

        $total = 0;

        if ((int) $data['is_pulang_pergi'] == 1) {
            $validator = Validator::make($request->all(), [
                'date_pulang' => 'required|date',
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

            $pulang = BusDeparture::with('busTravel', 'from', 'to')->find($data['id_ticket_pulang']);

            if (!$pulang) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Paket tiket pergi tidak ditemukan ',
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            $total += $pulang['price'];
        }

        $pergi = BusDeparture::with('busTravel', 'from', 'to')->find($data['id_ticket_pergi']);

        if (!$pergi) {
            return ResponseFormatter::error(
                [
                    'message' => 'Paket tiket pergi tidak ditemukan ',
                ],
                'Bus & Travel process failed',
                500,
            );
        }


        $kali = (int)$data['is_pulang_pergi'] == 1 ? 2 : 1;

        $total += $pergi['price'];

        $total = $total * $data['jumlah_penumpang'];



        $datas['is_pulang__pergi'] = $data['is_pulang_pergi'];
        $datas['jumlah_penumpang'] = $data['jumlah_penumpang'];
        $datas['jumlah_ticket'] = $data['jumlah_penumpang'] * $kali;
        $datas['total_biaya'] = $total;
        $datas['date_pergi'] = $data['date_pergi'];
        $datas['date_pulang'] = $data['date_pulang'];
        $datas['ticket_pergi'] = $this->formatSingleBus($pergi);
        $datas['ticket_pulang'] = $pulang !== [] ? $this->formatSingleBus($pulang) : [];



        return ResponseFormatter::success($datas, 'Data successfully loaded');
    }
}

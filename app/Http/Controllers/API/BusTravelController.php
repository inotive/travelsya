<?php

namespace App\Http\Controllers\API;

use App\Helpers\General;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BusCostumerHasChair;
use App\Models\BusDeparture;
use App\Models\BusRoute;
use App\Models\City;
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

    public function city(Request $request)
    {
        if ($request->from_city_id) {
            $city = BusDeparture::with('to')
                ->where('from_city_id', $request->from_city_id)
                ->get()
                ->pluck('to')
                ->unique('id')
                ->values();
        } else {
            $from = BusDeparture::with('from')->get()->pluck('from');
            $to = BusDeparture::with('to')->get()->pluck('to');
            $city = $from->merge($to)->unique('id')->values();
        }


        return ResponseFormatter::success(
            $city,
            'Load data success',
        );
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
                ['response' => $validator->errors()],
                'Bus & Travel process failed',
                500,
            );
        }

        if ((int)$request->is_pulang_pergi == 1) {
            $validator = Validator::make($request->all(), [
                'date_pulang' => 'required|date',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    ['response' => $validator->errors()],
                    'Bus & Travel process failed',
                    500,
                );
            }
        }

        $pergi = $this->findBuses($request->kota_awal, $request->kota_tujuan, $request->date_pergi);
        $pulang = [];

        if ((int)$request->is_pulang_pergi == 1) {
            $pulang = $this->findBuses($request->kota_tujuan, $request->kota_awal, $request->date_pulang);
        }

        $newData['is_pulang_pergi'] = $request->is_pulang_pergi;
        $newData['kota_awal'] = $request->kota_awal;
        $newData['kota_tujuan'] = $request->kota_tujuan;
        $newData['date_pergi'] = $request->date_pergi;
        $newData['date_pulang'] = $request->date_pulang;
        $newData['jumlah_penumpang'] = $request->jumlah_penumpang;
        $newData['pergi'] = $pergi;
        $newData['pulang'] = $pulang;

        return ResponseFormatter::success($newData, 'Data successfully loaded');
    }

    public function findBuses($from, $to, $date)
    {
        $busData = [];
        $dayMap = [
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
            'Sunday' => 'minggu',
        ];

        for ($i = 0; $i < 7; $i++) {
            $currentDate = Carbon::parse($date)->addDays($i);
            $dayName = $currentDate->format('l');
            $indonesianDayName = $dayMap[$dayName];

            $departures = BusDeparture::with('busTravel.busTravel', 'from', 'to')
                ->where('from_city_id', $from)
                ->where('to_city_id', $to)
                ->where('days', 'like', '%' . $indonesianDayName . '%')
                ->get();
            
            if ($departures->isNotEmpty()) {
                $busData[] = [
                    'date' => $currentDate->toDateString(),
                    'departures' => $this->formatBus($departures, $currentDate->toDateString()),
                ];
            }
        }

        return $busData;
    }

    public function formatBus($collections, $date = null)
    {
        $newTicket = [];

        foreach ($collections as $val) {
            $departureTime = Carbon::parse($date . ' ' . $val->departure_time);
            $arrivalTime = $departureTime->copy()->addHours($val->duration);

            $item = [
                'id' => $val->id,
                'business_name' => $val->busTravel->busTravel->business_name ?? 'Deleted business',
                'class' => $val->busTravel->class,
                'departure_point' => $val->titik_naik,
                'departure_time' => $departureTime->format('Y-m-d H:i:s'),
                'arrival_point' => $val->titik_turun,
                'arrival_time' => $arrivalTime->format('Y-m-d H:i:s'),
                'duration' => $val->duration,
                'price' => $val->price,
                'available_tickets' => General::busAvailableTicket($val, $date),
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
        }else{
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

            // Get seat reservations for this user, departure, and date
            $departureDate = Carbon::parse($berangkat)->format('Y-m-d');
            $seatReservations = BusCostumerHasChair::where('id_costumer', Auth::user()->id)
                ->where('id_departure', $pergi['id'])
                ->where('date_pergi', $departureDate)
                ->where('is_active', 1)
                ->orderBy('penumpang_ke')
                ->get();

            // Create multiple detail transaction records for multiple passengers
            for ($i = 0; $i < $data['jumlah_penumpang']; $i++) {
                $seatNumber = null;
                if (isset($seatReservations[$i])) {
                    $seatNumber = $seatReservations[$i]->kursi_pergi;
                }

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
                    "seat_number" => $seatNumber,
                ]);
            }

            if ((int)$data['is_pulang_pergi'] == 1) {
                // Get seat reservations for the return trip if available
                $returnDepartureDate = $berangkatPulang ? Carbon::parse($berangkatPulang)->format('Y-m-d') : null;
                $returnSeatReservations = $returnDepartureDate ? BusCostumerHasChair::where('id_costumer', Auth::user()->id)
                    ->where('id_departure', $pulang['id'])
                    ->where('date_pulang', $returnDepartureDate) // Using date_pulang for return trip
                    ->where('is_active', 1)
                    ->orderBy('penumpang_ke')
                    ->get() : collect();

                // Create multiple detail transaction records for return trip for multiple passengers
                for ($i = 0; $i < $data['jumlah_penumpang']; $i++) {
                    $returnSeatNumber = null;
                    if (isset($returnSeatReservations[$i])) {
                        $returnSeatNumber = $returnSeatReservations[$i]->kursi_pulang;
                    }

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
                        "seat_number" => $returnSeatNumber,
                    ]);
                }
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
        $datas['ticket_pergi'] = $this->formatSingleBus($pergi, $data['date_pergi']);
        $datas['ticket_pulang'] = $pulang !== [] ? $this->formatSingleBus($pulang, $data['date_pulang']) : [];



        return ResponseFormatter::success($datas, 'Data successfully loaded');
    }
}

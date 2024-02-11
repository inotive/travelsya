<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Carbon\Carbon;
use App\Models\Hostel;
use App\Services\Point;
use App\Helpers\General;
use App\Models\Facility;
use App\Services\Xendit;
use App\Services\Setting;
use App\Models\HostelRoom;
use App\Models\Transaction;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\DetailTransactionHostel;

class HostelController extends Controller
{
    protected $travelsya, $xendit;

    public function __construct(Travelsya $travelsya, Xendit $xendit)
    {
        $this->travelsya = $travelsya;
        $this->xendit = $xendit;
    }

    public function index(Request $request)
    {
        $hostels = Hostel::where('hostels.is_active', 1)->with('hostelRoom', 'hostelImage', 'hostelRating', 'hostelFacilities')->where('city', 'like', '%' . $request->location . '%')->withCount([
            "hostelRating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }
        ])->withCount("hostelRating as rating_count");

        if ($request->has('category')) {
            if ($request->category == 'monthly') {
                $hostels->withCount([
                    "hostelRoom as price_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(sellingrentprice_monthly),0)'));
                    }
                ]);
            }

            if ($request->category == 'yearly') {
                $hostels->withCount([
                    "hostelRoom as price_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(sellingrentprice_yearly),0)'));
                    }
                ]);
            }
        }

        if ($request->has('property')) {
            if ($request->property != '') {
                $hostels->where('property', $request->property);
            }
        }

        if ($request->has('roomtype')) {
            if ($request->roomtype != '') {
                $roomtype = $request->roomtype;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
                    $q->where('roomtype', $roomtype);
                });
            }
        }
        if ($request->has('guest')) {
            if ($request->guest != '' && $request->guest != 'max') {
                $guest = $request->guest;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($guest) {
                    $q->where('max_guest', '>=', $guest);
                });
            }
            if ($request->guest == 'max') {
                $guest = $request->guest;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($guest) {
                    $q->where('max_guest', '>', 10);
                });
            }
        }

        if ($request->has('furnish')) {
            if ($request->furnish != '') {
                $furnish = $request->furnish;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
                    $q->where('furnish', $furnish);
                });
            }
        }
        if ($request->has('start')) {
            $checkin = Carbon::parse($request->start);
            $duration = $request->duration;
            $checkout = $checkin->copy()->addMonths($duration);

            $hostels->whereRaw('(
                SELECT COUNT(*) FROM hostel_rooms hr WHERE hr.hostel_id = hostels.id
            ) - (
                SELECT COALESCE(SUM(room), 0) FROM detail_transaction_hostel dth WHERE dth.hostel_id = hostels.id
                AND (? < dth.reservation_end OR ? = dth.reservation_end)  -- Include reservations ending on the current day
                AND ? >= dth.reservation_start
            ) > 0', [$checkout->format('Y-m-d'), $checkout->format('Y-m-d'), $checkin->format('Y-m-d')]);

        }

        

        // if ($request->has('start')) {
        //     $checkin = Carbon::parse($request->start);
        //     $duration = $request->duration;

        //     // Hitung tanggal checkout
        //     $checkout = $checkin->copy()->addMonths($duration);

        //     $hostels->whereRaw('(
        //         SELECT COUNT(*) FROM hostel_rooms hr WHERE hr.hostel_id = hostels.id
        //     ) - (
        //         SELECT COALESCE(SUM(room), 0) FROM detail_transaction_hostel WHERE hostel_id = hostels.id
        //         AND ? <= reservation_end
        //         AND ? >= reservation_start
        //     ) > 0', [$checkout->format('Y-m-d'), $checkin->format('Y-m-d')]);

        // }



        if ($request->has('harga')) {
            $orderDirection = $request->harga === 'tertinggi' ? 'desc' : 'asc';


            if ($request->category == 'monthly') {
                $hostels->select('hostels.*', DB::raw('MIN(hostel_rooms.sellingrentprice_monthly) as price_avg'))->leftJoin('hostel_rooms', 'hostel_rooms.hostel_id', '=', 'hostels.id')->groupBy('hostels.id')->orderBy('price_avg', $orderDirection);
            }

            if ($request->category == 'yearly') {
                $hostels->select('hostels.*', DB::raw('MIN(hostel_rooms.sellingrentprice_yearly) as price_avg'))->leftJoin('hostel_rooms', 'hostel_rooms.hotel_id', '=', 'hostels.id')->groupBy('hostels.id')->orderBy('price_avg', $orderDirection);
            }
        }

        if ($request->has('star')) {
            $hostels->whereIn('star', $request->star);
        }

        if ($request->has('facility')) {
            $hostels->whereHas('hostelFacilities', function ($query) use ($request) {
                $query->whereIn('facility_id', $request->facility);
            });
        }

        // dd($hostels->get());
        $data['hostels'] = $hostels->get();
        $data['params'] = $request->all();
        $data['cities'] = Hostel::distinct()->select('city')->get();
        $data['facilities'] = Facility::all();

        return view('hostel.index', $data);
    }

    public function room($id, Request $request)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage', 'hostelRating', 'hostelFacilities');
        $hostelItem = Hostel::with('hostelRoom', 'hostelImage', 'hostelRating', 'hostelFacilities')->where('id', $id)->first();

        $startDate = date("Y-m-d", strtotime($request->start));
        $endDate = date("Y-m-d", strtotime("+" . $request->duration . " month", strtotime($startDate)));

        if ($request->has('category')) {
            if ($request->category == 'monthly') {
                $hostel->withCount([
                    "hostelRoom as price_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(sellingrentprice_monthly),0)'));
                    }
                ]);
            }

            if ($request->category == 'yearly') {
                $hostel->withCount([
                    "hostelRoom as price_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(sellingrentprice_yearly),0)'));
                    }
                ]);
            }
        }

        $data['hostelget'] = $hostel->withCount([
            "rating as rating_avg" => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }
        ])->withCount("rating as rating_count")->addSelect([
                    'availability_count' => DB::raw('COALESCE(
                    (SELECT COUNT(*) FROM hostel_rooms AS hr
                        WHERE hr.hostel_id = hostels.id
                        AND NOT EXISTS (
                            SELECT * FROM detail_transaction_hostel AS dt
                            WHERE dt.hostel_room_id = hr.id
                            AND (
                                (dt.reservation_start <= ? AND dt.reservation_end >= ?)
                                OR (dt.reservation_start <= ? AND dt.reservation_end >= ?)
                            )
                        )), 0)')
                ])->setBindings([$startDate, $startDate, $endDate, $endDate])->find($id);

        // dd($data['hostelget']);

        // foreach ($data['hostelget']->hostelRoom as $room) {
        //     $transactionCount = DB::table('detail_transaction_hostel')
        //         ->where('hostel_room_id', $room->id)
        //         ->where(function ($query) use ($startDate, $endDate) {
        //             $query->whereBetween('reservation_start', [$startDate, $endDate])
        //                 ->orWhereBetween('reservation_end', [$startDate, $endDate]);
        //         })
        //         ->count();

        //     $room->totalroom -= $transactionCount;
        // }

        // dd($data['hostelget']);

        $ratings = DB::table('hostel_ratings')->join('users', 'hostel_ratings.users_id', '=', 'users.id')->where('hostel_id', $id)->select('hostel_ratings.*', 'hostel_ratings.created_at as created', 'users.*')->limit(30)->get();

        Carbon::setLocale('id');
        // $formatted_created_at = null;

        if ($ratings->isNotEmpty()) {
            // Menggunakan first() untuk mendapatkan satu baris hasil
            $rating = $ratings->first();
            // $data['formatted_created_at'] = Carbon::parse($rating->created_at)->diffForHumans();
        }


        $jumlahTransaksi = $hostelItem->hostelRating->count();
        $totalRating = $hostelItem->hostelRating->sum('rate');
        $resultRating = 0;
        // Rating 5
        if ($jumlahTransaksi > 0) {
            $avgRating = $totalRating / $jumlahTransaksi;
            $resultRating = ($avgRating / 10) * 5;
        } else {
            $avgRating = 0;
            $resultRating = 0;
        }

        $data['avg_rate'] = $ratings->avg('rate');

        $data['rating'] = $ratings;
        $data['result_rating'] = $resultRating;

        $data['params'] = $request->all();

        // dd($request->all());
        $data['cities'] = Hostel::distinct()->select('city')->get();

        return view('hostel.room', $data);
    }

    public function checkout($id, Request $request)
    {
        $data['params'] = $request->all();
        $hostelRoom = HostelRoom::with('hostel')->findOrFail($id);

        $point = new Point;
        $data['point'] = $point->cekPoint(auth()->user()->id);

        if ($request->category == 'monthly') {
            $sellingprice = $hostelRoom->sellingrentprice_monthly;
        }

        if ($request->category == 'yearly') {
            $sellingprice = $hostelRoom->sellingrentprice_yearly;
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], 7, $request->user()->id, $sellingprice);

        $data['hostelRoom'] = $hostelRoom;
        $data['feeAdmin'] = $fees[0]['value'];
        $data['uniqueCode'] = rand(111, 999);
        $data['grandTotal'] = ($sellingprice * $request->duration) + $fees[0]['value'] + $data['uniqueCode'];

        return view('hostel.checkout', $data);
    }

    public function request(Request $request)
    {
        $data = $request->all();
        $hostel = HostelRoom::with('hostel.service')->find($data['hostel_room_id']);
        if ($data['category'] == 'monthly') {
            $sellingprice = $hostel->sellingrentprice_monthly;
        }

        if ($data['category'] == 'yearly') {
            $sellingprice = $hostel->sellingrentprice_yearly;
        }

        $invoice = "INV-" . date('Ymd') . "-HOSTEL-" . time();
        $fee = Fee::where('service_id', 7)->first();
        $fees = [['type' => 'Fee Admin', 'value' => $fee->value,], ['type' => 'Kode Unik', 'value' => $request->uniqueCode,],];
        
        $saldoPointCustomer = 0;
        if ($request->inputPoint == "on") {
            $saldoPointCustomer = Auth::user()->point;
            array_push($fees, ['type' => 'Point', 'value' => -$saldoPointCustomer,]);
        }

        // $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days);
        $qty = $data['duration'];
        if ($qty < 0)
            return 'Date must be forward';


        $setting = new Setting();

        $amount = $setting->getAmount($sellingprice, $qty, $fees, 1);
        // $amount = $data['grand_total'];

        $payoutsXendit = $this->xendit->create(['external_id' => $invoice, 'items' => [["product_id" => $data['hostel_room_id'], "name" => $hostel['name'], "price" => $sellingprice * $qty, "quantity" => 1,]], 'amount' => $amount, 'success_redirect_url' => route('user.profile'), 'failure_redirect_url' => route('user.profile'), 'invoice_duration ' => 72000, 'should_send_email' => true, 'customer' => ['given_names' => $request->user()->name, 'email' => $request->user()->email, 'mobile_number' => $request->user()->phone ?: "somenumber",], 'fees' => $fees]);

        $uniqueCode = $request->uniqueCode;
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hostel, $sellingprice, $uniqueCode, $saldoPointCustomer) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HTL-' . time(),
                'service' => 'hostel',
                'service_id' => 7, // 'payment' => $payoutsXendit['payment'],
                'payment' => 'xendit',
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount,
                "created_at" => Carbon::now(),
            ]);

            $helper = new General();
            // true buat detail

            $storeDetailTransaction = DetailTransactionHostel::create([
                'transaction_id' => $storeTransaction->id,
                'hostel_id' => $hostel->hostel_id,
                'hostel_room_id' => $data['hostel_room_id'],
                'type_rent' => $data['category'],
                "booking_id" => $helper->generateRandomString(6),
                "reservation_start" => Carbon::parse($data['start'])->format('Y-m-d'),
                "reservation_end" => Carbon::parse($data['end'])->format('Y-m-d'), // "guest"             => $data['total_guest'],
                // "room"              => $data['room'],
                "guest_name" => $data['nama_lengkap'],
                "guest_email" => $data['email'],
                "guest_handphone" => $data['no_telfon'],
                "guest" => $data['guest'],
                "room" => 1,
                "rent_price" => $sellingprice,
                "fee_admin" => $fees[0]['value'],
                "kode_unik" => $uniqueCode,
                "created_at" => Carbon::now(),
            ]);

            if ($request->inputPoint == "on") {
                //deductpoint
                $point = new Point;
                $point->deductPoint($request->user()->id, abs($saldoPointCustomer), $storeTransaction->id);
            }
        });

        return redirect($payoutsXendit['invoice_url']);
    }

    public function ajaxHostel(Request $request)
    {
        try {
            $hostels = Hostel::where('is_active', 1)->with('hostelRoom', 'hostelImage', 'rating');
            if ($request->name)
                $hostels->where('name', 'like', '%' . $request->name . '%');

            if ($request->city)
                $hostels->where('city', $request->city);

            if ($request->category)
                $hostels->where('category', 'like', '%' . $request->category . '%');

            if ($request->property)
                $hostels->where('property', $request->property);

            if ($request->furnish) {
                $furnish = $request->furnish;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
                    $q->where('furnish', $furnish);
                });
            }

            if ($request->roomtype) {
                $roomtype = $request->roomtype;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
                    $q->where('roomtype', $roomtype);
                });
            }
            $hostelsget = $hostels->withCount([
                "hostelRoom as price_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
                }
            ])->withCount([
                        "rating as rating_avg" => function ($q) {
                            $q->select(DB::raw('coalesce(avg(rate),0)'));
                        }
                    ])->withCount("rating as rating_count")->get();

            $hostelsCollect = collect($hostelsget);
            if ($request->optionsort == 'highestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'desc']])->values();

            if ($request->optionsort == 'lowestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'asc']])->values();

            if ($request->optionsort == 'review')
                $hotstelFIlter = $hostelsCollect->sortBy([['rating_avg', 'desc']])->values();

            if ($request->optionrate != null) {
                for ($i = 1; $i < 6; $i++) {
                    if ($request->optionrate == $i) {
                        $rate = $request->optionrate;
                        $hotstelFIlter = $hostelsCollect->filter(function ($values) use ($rate) {
                            return ceil($values['rating_avg']) == ceil($rate);
                        });
                    }
                }
            }

            return response()->json($hotstelFIlter->all());


            // return response()->json($pulsa);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function ajaxCity()
    {
        $hostelCity = Hostel::distinct()->select('city')->get();

        return response()->json(($hostelCity));
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequestUpdate;
use App\Models\HotelBookDate;
use App\Models\DetailTransaction;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\HotelImage;
use App\Models\HotelRoom;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class HotelController extends Controller
{
    protected $xendit, $point;
    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit =  $xendit;
        $this->point =  $point;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');
            if ($request->name)
                $hotel->where('name', 'like', '%' . $request->name . '%');

            if ($request->location)
                $hotel->where('city', 'like', '%' . $request->location . '%');

            if ($request->category)
                $hotel->where('category', 'like', '%' . $request->category . '%');

            if ($request->property)
                $hotel->where('property', $request->property);

            if ($request->furnish) {
                $furnish = $request->furnish;
                $hotel->withWhereHas('hotelRoom', function ($q) use ($furnish) {
                    $q->where('furnish', $furnish);
                });
            }

            if ($request->roomtype) {
                $roomtype = $request->roomtype;
                $hotel->withWhereHas('hotelRoom', function ($q) use ($roomtype) {
                    $q->where('roomtype', $roomtype);
                });
            }

            $hotelget = $hotel->withCount(["hotelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(price),0)'));
            }])->withCount(["hotelRating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("hotelRating as rating_count")->get();

            if (count($hotelget)) {
                return ResponseFormatter::success($hotelget, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th->getMessage(),
                'message' => 'Something wrong',
            ], 'Hotel process failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            // $hotel = Hotel::find($hotel->id);
            $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating')->where('is_active', 1)->where('id', $id);


            if ($request->start_date) {
                $date = [
                    'start' => $request->start_date,
                    'end' => $request->end_date
                ];
                $hotel->with(['hotelRoom' => function ($query) use ($date) {
                    $query->withCount(['hotelBookDate as existsDate' => function ($q) use ($date) {
                        $q->where('start', '>=', $date['start']);
                        $q->where('end', '<=', $date['end']);
                        $q->select(DB::raw('count(id)'));
                    }])->with('hotelBookDate');
                }]);
                // $hotelCollect =  collect($bookdate);

                // $filter =  array_filter($hotelCollect->toArray(), function ($var) {
                //     foreach ($var['hotel_room'] as $value) {
                //         return ($value['existsDate'] == 0);
                //     }
                // });

                // return $filter;
            }
            $hotelGet = $hotel->get();

            if (count($hotelGet)) {
                return ResponseFormatter::success($hotelGet, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Hostel process failed', 500);
        }
    }

    public function requestTransaction(Request $request)
    {
        // handle validation
        $validator = Validator::make($request->all(), [
            "service" => "required|string",
            "payment" => "required|string",
            "point" => "required",
            "hotel_room_id" => "required",
            "guest" => "required",
            "start" => "required",
            "end" => "required",

        ]);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'Hostel process failed', 500);
        }

        $data = $request->all();
        $hotel = HotelRoom::with('hotel.service')->find($data['hotel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($hotel->hotel->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $hotel->hotel->service_id, $request->user()->id, $hotel->sellingprice);

        //cekpoint
        if (!$fees) return ResponseFormatter::error(null, 'Point invalid');
        $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days) - 1 ?: 1;
        if ($qty < 0) return ResponseFormatter::error(null, 'Date must be forward');
        $amount = $setting->getAmount($hotel->sellingprice, $qty, $fees);

        // cek book date
        $checkBook = HotelBookDate::where("hotel_room_id", $data['hotel_room_id'])->where('start', '>=', $data['start'])->where('end', "<=", $data['end'])->first();

        if ($checkBook) {
            return ResponseFormatter::error($checkBook, 'Book dates is not available');
        }

        // ceate xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hotel_room_id'],
                    "name" => $hotel['name'],
                    "price" => $hotel->sellingprice,
                    "quantity" => $qty,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url'  => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: "somenumber",
            ],
            'fees' => $fees
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hotel) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HTL-' . time(),
                'service' => $hotel->hotel->service->name,
                'service_id' => $hotel->hotel->service_id,
                'payment' => $data['payment'],
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount
            ]);


            // true buat detail
            $storeDetailTransaction = DetailTransaction::create([
                'transaction_id' => $storeTransaction->id,
                'hotel_room_id' => $data['hotel_room_id'],
                "qty" => $qty,
                "price" => $hotel->sellingprice
            ]);


            // true buat bookdate
            $storeBookDate = HotelBookDate::create([
                'start' => $data['start'],
                'end' => $data['end'],
                'hotel_room_id' => $data["hotel_room_id"],
                'transaction_id' => $storeTransaction->id
            ]);

            // true buat guest
            foreach ($data['guest'] as $guest) {
                $storeGuest = Guest::create([
                    'transaction_id' => $storeTransaction->id,
                    // 'type_id' => $guest['type_id'],
                    // 'identity' => $guest['identity'],
                    'name' => $guest['name'],
                    'email' => $guest['email'],
                    'phone' => $guest['phone'],
                ]);
            }
            if ($data['point']) {
                //deductpoint
                $point = new Point;
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $storeTransaction->id);
            }
        });


        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function hotelCity()
    {
        $hotelCity = Hotel::distinct()->pluck('city');

        if (!$hotelCity)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hotelCity, 'Data successfully loaded');
    }

    public function hotelPopuler()
    {
        $hotelPopuler = Hotel::with('hotelImage', 'hotelRating')
            ->withCount(["hotelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(price),0)'));
            }])->withCount(["hotelRating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("hotelRating as rating_count")
            ->orderBy('rating_count', 'DESC')
            ->orderBy('rating_avg', 'DESC')
            ->orderBy('price_avg', "desc")->get();

        if (!$hotelPopuler)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hotelPopuler, 'Data successfully loaded');
    }
}

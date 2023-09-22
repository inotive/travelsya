<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequestUpdate;
use App\Models\BookDate;
use App\Models\DetailTransaction;
use App\Models\Guest;
use App\Models\Hostel;
use App\Models\HostelImage;
use App\Models\HostelRoom;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class HostelController extends Controller
{
    protected $xendit, $point;
    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');

            if ($request->location) {
                $hostels->where('city', 'like', '%' . $request->location . '%');
            }

            if ($request->type_duration) {
                $hostels->where('category', $request->type_duration);
            }

            if ($request->has('property_type')) {
                if ($request->property_type != 'semua') {
                    $hostels->where('property', $request->property_type);
                }
            }

            if ($request->has('property_room')) {
                if ($request->property_room != 'semua') {
                    $roomtype = $request->property_room;
                    $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
                        $q->where('roomtype', $roomtype);
                    });
                }
            }

            if ($request->has('property_furnish')) {
                if ($request->property_furnish != 'semua') {
                    $furnish = $request->property_furnish;
                    $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
                        $q->where('furnish', $furnish);
                    });
                }
            }

            if ($request->has('rent_start') && $request->has('rent_end')) {
                $hostels->whereRaw('(
                    SELECT SUM(totalroom) FROM hostel_rooms hr WHERE hr.hostel_id = hostels.id
                ) - (
                    SELECT COALESCE(SUM(room), 0) FROM detail_transaction_hostel WHERE hostel_id = hostels.id
                    AND ? <= reservation_end
                    AND ? >= reservation_start
                ) > 0', [$request->rent_end, $request->rent_start]);
            }


            $hostelsget = $hostels->withCount([
                "hostelRoom as price_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(price),0)'));
                }
            ])->withCount([
                "rating as rating_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(rate),0)'));
                }
            ])->withCount("rating as rating_count")->get();



            $hostelShow = $hostelsget->map(function ($hostelsget) {

                $hostelImage = $hostelsget->hostelImage->where('main', 1)->first();

                return [
                    'name' => $hostelsget->name,
                    'image' => $hostelImage ? asset($hostelImage->image) : null,
                    'location' => $hostelsget->city,
                    'rating_avg' => intval($hostelsget->rating_avg),
                    'rating_count' => $hostelsget->rating_count,
                    'sellingprice' => intval($hostelsget->price_avg),
                ];
            });

            if (count($hostelShow)) {
                return ResponseFormatter::success($hostelShow, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th->getMessage(),
                'message' => 'Something wrong',
            ], 'Hostel process failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            // $hostel = Hostel::find($hostel->id);
            $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating', 'hostelFacilities')
                ->withCount([
                    "hostelRoom as price_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(price),0)'));
                    }
                ])->withCount([
                    "rating as rating_avg" => function ($q) {
                        $q->select(DB::raw('coalesce(avg(rate),0)'));
                    }
                ])->withCount("rating as rating_count")
                ->find($id);

            // if ($request->start_date) {
            //     $date = [
            //         'start' => $request->start_date,
            //         'end' => $request->end_date
            //     ];
            //     $hostel->with(['hostelRoom' => function ($query) use ($date) {
            //         $query->withCount(['bookDate as existsDate' => function ($q) use ($date) {
            //             $q->where('start', '>=', $date['start']);
            //             $q->where('end', '<=', $date['end']);
            //             $q->select(DB::raw('count(id)'));
            //         }])->with('bookDate');
            //     }]);
            //     // $hostelCollect =  collect($bookdate);

            //     // $filter =  array_filter($hostelCollect->toArray(), function ($var) {
            //     //     foreach ($var['hostel_room'] as $value) {
            //     //         return ($value['existsDate'] == 0);
            //     //     }
            //     // });

            //     // return $filter;
            // }
            // $hostelGet = $hostel->get();
            $hostelGet = collect([$hostel])->map(function ($hostel) {
                return [
                    'name' => $hostel->name,
                    'image' => $hostel->image,
                    'checkin' => $hostel->checkin,
                    'checkout' => $hostel->checkout,
                    'location' => $hostel->city,
                    'avg_rating' => intval($hostel->rating_avg),
                    'rating_count' => $hostel->rating_count,
                    'hotel_rooms' => $hostel->hostelRoom,
                    'hostel_facilities' => $hostel->hostelFacilities,
                    'hostel_rules' => $hostel->hostelRules,
                    'hostel_reviews' => $hostel->rating,
                ];
            });

            if (count($hostelGet)) {
                return ResponseFormatter::success($hostelGet, 'Data successfully loaded');
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

    public function room($id)
    {
        try {
            $hostels = HostelRoom::with('hostel')->findOrFail($id);

            if ($hostels) {
                return ResponseFormatter::success($hostels, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th->getMessage(),
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
            "hostel_room_id" => "required",
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
        $hostel = HostelRoom::with('hostel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($hostel->hostel->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $hostel->hostel->service_id, $request->user()->id, $hostel->sellingprice);

        //cekpoint 
        if (!$fees)
            return ResponseFormatter::error(null, 'Point invalid');
        $start = new DateTime($data['start']);
        $end = new DateTime($data['end']);
        $interval = $end->diff($start);
        $qty = $interval->format('%m');
        $amount = $setting->getAmount($hostel->sellingprice, $qty, $fees);

        // cek book date
        $checkBook = BookDate::where("hostel_room_id", $data['hostel_room_id'])->where('start', '>=', $data['start'])->where('end', "<=", $data['end'])->first();
        if ($checkBook) {
            return ResponseFormatter::error($checkBook, 'Book dates is not available');
        }

        // ceate xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hostel_room_id'],
                    "name" => $hostel['name'],
                    "price" => $hostel->sellingprice,
                    "quantity" => $qty,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url' => route('redirect.succes'),
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
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hostel) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HST-' . time(),
                'service' => $hostel->hostel->service->name,
                'service_id' => $hostel->hostel->service_id,
                'payment' => $data['payment'],
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount
            ]);


            // true buat detail
            $storeDetailTransaction = DetailTransaction::create([
                'transaction_id' => $storeTransaction->id,
                'hostel_room_id' => $data['hostel_room_id'],
                "qty" => $qty,
                "price" => $hostel->sellingprice
            ]);


            // true buat bookdate
            $storeBookDate = BookDate::create([
                'start' => $data['start'],
                'end' => $data['end'],
                'hostel_room_id' => $data["hostel_room_id"],
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

    public function hostelCity()
    {
        $hostelCity = Hostel::distinct()->pluck('city');

        if (!$hostelCity)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hostelCity, 'Data successfully loaded');
    }

    public function hostelPopuler()
    {
        $hostelPopuler = Hostel::with('hostelImage', 'rating')
            ->withCount([
                "hostelRoom as price_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(price),0)'));
                }
            ])->withCount([
                "rating as rating_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(rate),0)'));
                }
            ])->withCount("rating as rating_count")
            ->orderBy('rating_count', 'DESC')
            ->orderBy('rating_avg', 'DESC')
            ->orderBy('price_avg', "desc")->get();

        if (!$hostelPopuler)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hostelPopuler, 'Data successfully loaded');
    }
}

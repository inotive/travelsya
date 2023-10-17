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
            // $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');

            // if ($request->name)
            //     $hotel->where('name', 'like', '%' . $request->name . '%');

            // if ($request->location)
            //     $hotel->where('city', 'like', '%' . $request->location . '%');

            // if ($request->category)
            //     $hotel->where('category', 'like', '%' . $request->category . '%');

            // if ($request->property)
            //     $hotel->where('property', $request->property);

            // if ($request->furnish) {
            //     $furnish = $request->furnish;
            //     $hotel->withWhereHas('hotelRoom', function ($q) use ($furnish) {
            //         $q->where('furnish', $furnish);
            //     });
            // }

            // if ($request->roomtype) {
            //     $roomtype = $request->roomtype;
            //     $hotel->withWhereHas('hotelRoom', function ($q) use ($roomtype) {
            //         $q->where('roomtype', $roomtype);
            //     });
            // }

            // if (count($hotelget)) {
            //     return ResponseFormatter::success($hotelget, 'Data successfully loaded');
            // } else {
            //     return ResponseFormatter::error(null, 'Data not found');
            // }

            $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');

            if ($request->has('location')) {
                if ($request->location != 'semua') {
                    $hotels->where('city', 'like', '%' . $request->location . '%');
                }
            }

            if ($request->has('room')) {
                $hotels->whereHas('hotelRoom', function ($query) use ($request) {
                    $query->where('totalroom', '>=', $request->room);
                });
            }

            if ($request->has('guest')) {
                $hotels->whereHas('hotelRoom', function ($query) use ($request) {
                    $query->where('guest', '>=', $request->guest);
                });
            }

            if ($request->has('check_in') && $request->has('check_out')) {
                $hotels->whereRaw('(
                    SELECT SUM(totalroom) FROM hotel_rooms hr WHERE hr.hotel_id = hotels.id
                ) - (
                    SELECT COALESCE(SUM(room), 0) FROM detail_transaction_hotel WHERE hotel_id = hotels.id
                    AND ? <= guest
                    AND ? >= reservation_start
                ) > 0', [$request->check_out, $request->check_in]);
            }

            $hotelget = $hotels->get();
            $hotelDetails = [];
            $hotelFormatJSON = [];

            foreach ($hotelget as $hotel) {
                $minPrice = $hotel->hotelRoom->min('price');
                $maxPrice = $hotel->hotelRoom->min('sellingprice');
                $jumlahTransaksi = $hotel->hotelRating->count();
                $totalRating = $hotel->hotelRating->sum('rate');

                // Rating 5
                if ($jumlahTransaksi > 0) {
                    $avgRating = $totalRating / $jumlahTransaksi;
                    $resultRating = ($avgRating / 10) * 5;
                } else {
                    $avgRating = 0;
                    $resultRating = 0;
                }

                $hotelDetails[$hotel->id] = [
                    'avg_rating' => $avgRating,
                    'rating_count' => $resultRating,
                    'price' => $minPrice,
                    'sellingprice' => $maxPrice,
                ];

                $hotelImage = $hotel->hotelImage->where('main', 1)->first();

                $hotelFormatJSON[] = [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'image' => $hotelImage ? asset('storage/' . $hotelImage->image) : null,
                    'location' => $hotel->city,
                    'address' => $hotel->address,
                    'lat' => $hotel->lat,
                    'lon' => $hotel->lon,
                    'avg_rating' => $hotelDetails[$hotel->id]['avg_rating'],
                    'rating_count' => $hotelDetails[$hotel->id]['rating_count'],
                    'price' => $hotelDetails[$hotel->id]['price'],
                    'sellingprice' => $hotelDetails[$hotel->id]['sellingprice'],
                ];
            }

            if (count($hotelFormatJSON)) {
                return ResponseFormatter::success($hotelFormatJSON, 'Data successfully loaded');
            } else {
                return ResponseFormatter::success([], 'Data successfully loaded');
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
            // $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating')
        //     ->find($id);

            // if ($request->start_date) {
            //     $date = [
            //         'start' => $request->start_date,
            //         'end' => $request->end_date
            //     ];
            //     $hotel->with(['hotelRoom' => function ($query) use ($date) {
            //         $query->withCount(['hotelBookDate as existsDate' => function ($q) use ($date) {
            //             $q->where('start', '>=', $date['start']);
            //             $q->where('end', '<=', $date['end']);
            //             $q->select(DB::raw('count(id)'));
            //         }])->with('hotelBookDate');
            //     }]);
            //     // $hotelCollect =  collect($bookdate);

            //     // $filter =  array_filter($hotelCollect->toArray(), function ($var) {
            //     //     foreach ($var['hotel_room'] as $value) {
            //     //         return ($value['existsDate'] == 0);
            //     //     }
            //     // });

            //     // return $filter;
            // }

            $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelroomFacility', 'hotelRule')
                ->find($id);

            $jumlahTransaksi = $hotel->hotelRating->count();
            $totalRating = $hotel->hotelRating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating = $totalRating / $jumlahTransaksi;
            } else {
                $avgRating = 0;
            }

            $hotelGet = collect([$hotel])->map(function ($hotel) use ($avgRating, $totalRating) {

                $hotel_room = $hotel->hotelRoom->map(function ($room) {
                    return [
                        'id' => $room->id,
                        'name' => $room->name,
                        'description' => $room->description,
                        'price' => $room->price,
                        'sellingprice' => $room->sellingprice,
                        'bed_type' => $room->bed_type,
                        'roomsize' => $room->roomsize,
                        'maxextrabed' => $room->maxextrabed,
                        'totalroom' => $room->totalroom,
                        'guest' => $room->guest,
                        'hotel_room_image' => $room->hotelRoomImage
                    ];
                });

                $hotel_facilities = $hotel->hotelroomFacility->map(function ($facility) {
                    return [
                        // 'hotel_id' => $facility->hotel_id,
                        // 'hotel_room_id' => $facility->hotel_room_id,
                        // 'facility_id' => $facility->facility_id,
                        'name' => $facility->facility->name,
                    ];
                });

                $hotelImage = $hotel->hotelImage->where('main', 1)->first();
                $hotel_ratings = null;
                if ($hotel->hotelRating != null) {
                    $hotel_ratings = $hotel->hotelRating->map(function ($hr) {
                        return [
                            "id" => $hr->id,
                            "transaction_id" => $hr->transaction_id,
                            "user_id" => $hr->user_id,
                            "user_name" => User::where('id', $hr->user_id)->first()->name,
                            "hotel_id" => $hr->hotel_id,
                            "rate" => $hr->rate,
                            "comment" => $hr->comment,
                            "deleted_at" => $hr->deleted_at,
                            "created_at" => $hr->created_at,
                            "updated_at" => $hr->updated_at,
                        ];
                    });
                };

                return [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'image' => $hotelImage ? asset('storage/' . $hotelImage->image) : null,
                    'checkin' => $hotel->checkin,
                    'checkout' => $hotel->checkout,
                    'location' => $hotel->city,
                    'address' => $hotel->address,
                    'lat' => $hotel->lat,
                    'lon' => $hotel->lon,
                    'avg_rating' => $avgRating,
                    'rating_count' => $totalRating,
                    'hotel_rooms' => $hotel_room,
                    'hotel_facilities' => $hotel_facilities,
                    'hotel_rules' => $hotel->hotelRule,
                    'hotel_reviews' => $hotel_ratings,
                ];
            });

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
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper('hotel') . "-" . time();
        // $setting = new Setting();
        // $fees = $setting->getFees($data['point'], $hotel->hotel->service_id, $request->user()->id, $hotel->sellingprice);

        //cekpoint
        // if (!$fees)
        //     return ResponseFormatter::error(null, 'Point invalid');
        // if ($qty < 0)
        //     return ResponseFormatter::error(null, 'Date must be forward');
        // $amount = $setting->getAmount($hotel->sellingprice, $qty, $fees, 1);
        $amount = $hotel->sellingprice;
        $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days) - 1 ?: 1;
        $fees = [
            [
                'type' => 'admin',
                'value' => 2500,
            ],
        ];

        // cek book date
        // $checkBook = HotelBookDate::where("hotel_room_id", $data['hotel_room_id'])
        //     ->where('start', '>=', $data['start'])
        //     ->where('end', "<=", $data['end'])
        //     ->first();

        // if ($checkBook) {
        //     return ResponseFormatter::error($checkBook, 'Book dates is not available');
        // }

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
            'amount' => $amount + $fees[0]['value'],
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                // 'given_names' => $request->user()->name,
                // 'email' => $request->user()->email,
                // 'mobile_number' => $request->user()->phone ?: "somenumber",
                'given_names' => 'Admin2',
                'email' => 'admin2@travelsya.test',
                'mobile_number' => 'somenumber',
            ],
            'fees' => $fees
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hotel) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HTL-' . time(),
                'service' => 'hotel',
                'service_id' => 8,
                // 'service' => $hotel->hotel->service->name,
                // 'service_id' => $hotel->hotel->service_id,
                'payment' => $data['payment'],
                // 'user_id' => $request->user()->id,
                'user_id' => 3,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount
            ]);


            // true buat detail
            // $storeDetailTransaction = DetailTransaction::create([
            //     'transaction_id' => $storeTransaction->id,
            //     'hotel_room_id' => $data['hotel_room_id'],
            //     "qty" => $qty,
            //     "price" => $hotel->sellingprice
            // ]);


            // true buat bookdate
            // $storeBookDate = HotelBookDate::create([
            //     'start' => $data['start'],
            //     'end' => $data['end'],
            //     'hotel_room_id' => $data["hotel_room_id"],
            //     'transaction_id' => $storeTransaction->id
            // ]);


            try {
                $storeDetailTransaction = DB::table('detail_transaction_hotel')
                    ->insert([
                        'transaction_id' => $storeTransaction->id,
                        'hotel_id' => $hotel->hotel_id,
                        'hotel_room_id' => $data['hotel_room_id'],
                        'booking_id' => Str::random(6),
                        'reservation_start' =>  $data['start'],
                        'reservation_end' =>  $data['end'],
                        'guest' =>  count($data['guest']),
                        'room' => 1,
                        "rent_price" => $hotel->sellingprice,
                        "fee_admin" => $fees[0]['value'],
                    ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => 'Error Store Data Transaction'
                ]);
            }


            // true buat guest
            // foreach ($data['guest'] as $guest) {
            //     $storeGuest = Guest::create([
            //         'transaction_id' => $storeTransaction->id,
            //         // 'type_id' => $guest['type_id'],
            //         // 'identity' => $guest['identity'],
            //         'name' => $guest['name'],
            //         'email' => $guest['email'],
            //         'phone' => $guest['phone'],
            //     ]);
            // }

            // if ($data['point']) {
            //     //deductpoint
            //     $point = new Point;
            //     $point->deductPoint($request->user()->id, abs($fees[1]['value']), $storeTransaction->id);
            // }
        });


        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function hotelCity()
    {
        $hotelCity = Hotel::distinct()->pluck('city');

        if (!$hotelCity)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hotelCity, 'Data successfully loaded');
    }

    public function hotelPopuler(Request $request)
    {
        // $hotelPopuler = Hotel::with('hotelImage', 'hotelRating')
        //     ->withCount([
        //         "hotelRoom as price_avg" => function ($q) {
        //             $q->select(DB::raw('coalesce(avg(price),0)'));
        //         }
        //     ])
        //     ->withCount([
        //         "hotelRating as rating_avg" => function ($q) {
        //             $q->select(DB::raw('coalesce(avg(rate),0)'));
        //         }
        //     ])
        //     ->withCount("hotelRating as rating_count")
        //     ->orderBy('rating_count', 'DESC')
        //     ->orderBy('rating_avg', 'DESC')
        //     ->orderBy('price_avg', "desc")
        //     ->get();


        $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');

        if ($request->has('location')) {
            $hotels->where('city', 'like', '%' . $request->location . '%');
        }

        $hotelget = $hotels->get();
        $hotelDetails = [];
        $hotelFormatJSON = [];
        foreach ($hotelget as $hotel) {
            $minPrice = $hotel->hotelRoom->min('price');
            $maxPrice = $hotel->hotelRoom->min('sellingprice');
            $jumlahTransaksi = $hotel->hotelRating->count();
            $totalRating = $hotel->hotelRating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating = $totalRating / $jumlahTransaksi;
            } else {
                $avgRating = 0;
            }

            $hotelDetails[$hotel->id] = [
                'avg_rating' => $avgRating,
                'rating_count' => $jumlahTransaksi,
                'price' => $minPrice,
                'sellingprice' => $maxPrice,
            ];

            $imageUrl = "-";
            //retrieve image url
            if (!$hotel->hotelImage->isEmpty()) {
                $imageUrl = $hotel->hotelImage[0]->image;
            }


            $hotelFormatJSON[] = [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'image' => $imageUrl,
                'location' => $hotel->city,
                'address' => $hotel->address,
                'lat' => $hotel->lot,
                'lon' => $hotel->lon,
                'avg_rating' => $hotelDetails[$hotel->id]['avg_rating'],
                'rating_count' => $hotelDetails[$hotel->id]['rating_count'],
                'price' => $hotelDetails[$hotel->id]['price'],
                'sellingprice' => $hotelDetails[$hotel->id]['sellingprice'],
            ];

            usort($hotelFormatJSON, function ($a, $b) {
                // Mengurutkan berdasarkan avg_rating secara menurun (dari tertinggi ke terendah)
                $avgRatingComparison = $b['avg_rating'] - $a['avg_rating'];

                // Jika avg_rating sama, maka urutkan berdasarkan rating_count secara menurun
                if ($avgRatingComparison === 0) {
                    return $b['rating_count'] - $a['rating_count'];
                }

                return $avgRatingComparison;
            });
        }

        if (!$hotelFormatJSON) {
            return ResponseFormatter::error(null, 'Data not found');
        }

        return ResponseFormatter::success($hotelFormatJSON, 'Data successfully loaded');
    }
}

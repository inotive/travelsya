<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequestUpdate;
use App\Models\Fee;
use App\Models\HistoryPoint;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use DateTime;

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

            $hotels = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelImage', 'hotelRating');

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
                $checkin = Carbon::parse($request->check_in);
                $checkout = Carbon::parse($request->check_out);
                $hotels->whereRaw(
                    '(
                        SELECT COUNT(*) FROM hotel_rooms hr
                        WHERE hr.hotel_id = hotels.id
                        AND hr.totalroom - COALESCE((
                            SELECT SUM(dth.room) FROM detail_transaction_hotel dth
                            WHERE dth.hotel_id = hotels.id
                            AND (? < dth.reservation_end OR ? = dth.reservation_end)
                            AND ? >= dth.reservation_start
                        ), 0) > 0
                    ) > 0',
                    [$checkout->format('Y-m-d'), $checkout->format('Y-m-d'), $checkin->format('Y-m-d')]
                );
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
                    $resultRating = $hotel->hotelRating->count();
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
                $avg_rating = $hotel->hotelRating->sum('rate') != 0 ? $hotel->hotelRating->sum('rate') / $hotel->hotelRating->count() : 0;

                $hotelFormatJSON[] = [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'image' => $hotelImage ? asset('storage/' . $hotelImage->image) : null,
                    'location' => $hotel->city,
                    'address' => $hotel->address,
                    'lat' => $hotel->lat,
                    'lon' => $hotel->lon,
                    'avg_rating' => $avg_rating,
                    'rating_count' => $hotel->hotelRating->count(),
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
            return ResponseFormatter::error([$th->getMessage(), 'message' => 'Something wrong'], 'Hotel process failed', 500);
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

            $hotel = Hotel::where('is_active', 1)
                ->with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelroomFacility', 'hotelRule')
                ->find($id);

            $jumlahTransaksi = $hotel->hotelRating->count();
            $totalRating = $hotel->hotelRating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating = $totalRating / $jumlahTransaksi;
            } else {
                $avgRating = 0;
            }

            $hotelGet = collect([$hotel])->map(function ($hotel) use ($avgRating, $totalRating, $request) {
                $hotel_room = $hotel->hotelRoom->map(function ($room) use ( $request){
                    $startDate = date('Y-m-d', strtotime($request->start_date));
                    $endDate = date('Y-m-d', strtotime('+' . $request->end_date . ' month', strtotime($startDate)));
                    $transactionCount = DB::table('detail_transaction_hotel')
                        ->where('hotel_room_id', $room->id)
                        ->where('reservation_start', '<=', $startDate)
                        ->where('reservation_end', '>=', $endDate)
                        ->sum('room');

                    $roomLeft = $room->totalroom - $transactionCount;
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
                        'room_left' => $roomLeft < 0 ? 0 : $roomLeft,
                        'guest' => $room->guest,
                        'hotel_room_image' => $room->hotelRoomImage,
                    ];
                });

                // $hotel_facilities = $hotel->hotelroomFacility->map(function ($facility) {
                //     return [
                //         // 'hotel_id' => $facility->hotel_id,
                //         // 'hotel_room_id' => $facility->hotel_room_id,
                //         'id' => $facility->facility_id,
                //         'name' => $facility->facility->name,
                //         'image' => 'storage/' . $facility->facility->icon,
                //     ];
                // });

                $hotel_facilities = $hotel->hotelroomFacility->groupBy('facility.name')->map(function ($group) {
                    return [
                        'id' => $group->first()->facility_id,
                        'name' => $group->first()->facility->name,
                        'image' => 'storage/' . $group->first()->facility->icon,
                    ];
                });
                

                $hotelImage = $hotel->hotelImage->where('main', 1)->first();
                $avg_rating = $hotel->hotelRating->sum('rate') != 0 ? $hotel->hotelRating->sum('rate') / $hotel->hotelRating->count() : 0;

                $hotel_ratings = $hotel->hotelRating->map(function ($hr) {
                    return [
                        'id' => $hr->id,
                        'transaction_id' => $hr->transaction_id,
                        'user_id' => $hr->users_id,
                        'user_name' => User::where('id', $hr->users_id)
                            ->pluck('name')
                            ->first(),
                        'hotel_id' => $hr->hotel_id,
                        'rate' => $hr->rate,
                        'comment' => $hr->comment,
                        'deleted_at' => $hr->deleted_at,
                        'created_at' => $hr->created_at,
                        'updated_at' => $hr->updated_at,
                    ];
                });
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
                    'avg_rating' => $avg_rating,
                    'rating_count' => $hotel->hotelRating->count(),
                    'hotel_image' => $hotel->hotelImage,
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
            return ResponseFormatter::error([$th, 'message' => 'Something wrong'], 'Hostel process failed', 500);
        }
    }

    public function room($id)
    {
        try {
            $hotels = HotelRoom::with('hotel', 'hotelroomFacility', 'hotelroomImage')->find($id);

            if (!$hotels) {
                return ResponseFormatter::error(null, 'Data not found');
            }

            $hotel = collect([$hotels])->map(function ($room) {
                $room_facilities = $room->hotelroomFacility
                    ->map(function ($facilities) {
                        return [
                            'id' => $facilities->facility_id,
                            'name' => $facilities->facility->name,
                            'icon' => $facilities->facility->icon,
                        ];
                    })
                    ->unique('facility_id');

                $room_images = $room->hotelroomImage
                    ->map(function ($facilities) {
                        return [
                            'image' => $facilities->image,
                        ];
                    })
                    ->unique('image');

                return [
                    'room_size' => $room->roomsize,
                    'max_guest' => $room->guest,
                    'description' => $room->description,
                    'room_facilities' => $room_facilities,
                    'room_images' => $room_images,
                ];
            });

            return ResponseFormatter::success($hotel, 'Data successfully loaded');
        } catch (Exception $th) {
            return ResponseFormatter::error([$th->getMessage(), 'message' => 'Something wrong'], 'Hostel process failed', 500);
        }
    }

    public function requestTransaction(Request $request)
    {
        // handle validation
        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'payment' => 'required|string',
            'point' => 'required',
            'hotel_room_id' => 'required',
            'guest' => 'required',
            'start' => 'required',
            'end' => 'required',
            'total_room' => 'required',
            'total_guest' => 'required',
            'kode_unik' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'response' => $validator->errors(),
                ],
                'Hostel process failed',
                500,
            );
        }

        $data = $request->all();
        $start = Carbon::parse($data['start']);
        $end = Carbon::parse($data['end']);

        $totalDay = $start->diffInDays($end);

        $hotel = HotelRoom::with('hotel.service')->find($data['hotel_room_id']);
        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('hotel') . '-' . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], 8, $request->user()->id, $hotel->sellingprice);

        $amount = $hotel->sellingprice * $totalDay * $request->total_room;

        $fee = Fee::where('service_id', 8)->first();
        $fees = [
            [
                'type' => 'Admin',
                'value' => $fee->percent == 0 ? $fee->value : ($amount * $fee->value) / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $data['kode_unik'],
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
                    'product_id' => $data['hotel_room_id'],
                    'name' => $hotel['name'],
                    'price' => $amount, // tanpa pajak
                    'quantity' => 1,
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $data['kode_unik'], // include pajak
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $data['guest'][0]['name'],
                'email' => $data['guest'][0]['email'],
                'mobile_number' => $data['guest'][0]['phone'] ?? 'somenumber',
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $totalDay, $amount, $fees, $hotel, $saldoPointCustomer) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HTL-' . time(),
                'service' => 'hotel',
                'service_id' => 8,
                'payment' => $data['payment'],
                'user_id' => Auth::user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount + $fees[0]['value'] + $data['kode_unik'],
            ]);
            // Pengurangan Point
            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint($request->user()->id, $saldoPointCustomer, $storeTransaction->id);
            }

            try {
                $storeDetailTransaction = DB::table('detail_transaction_hotel')->insert([
                    'transaction_id' => $storeTransaction->id,
                    'hotel_id' => $hotel->hotel_id,
                    'hotel_room_id' => $data['hotel_room_id'],
                    'booking_id' => Str::random(6),
                    'reservation_start' => $data['start'],
                    'reservation_end' => $data['end'],
                    'guest' => $request->total_guest,
                    'room' => $request->total_room,
                    'rent_price' => $hotel->sellingprice,
                    'fee_admin' => $fees[0]['value'],
                    'kode_unik' => $data['kode_unik'],
                    'guest_name' => $data['guest'][0]['name'],
                    'guest_email' => $data['guest'][0]['email'],
                    'guest_handphone' => $data['guest'][0]['phone'],
                    'created_at' => Carbon::now()->timezone('Asia/Makassar'),
                ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => 'Error Store Data Transaction',
                ]);
            }
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function hotelCity()
    {
        $hotelCity = Hotel::distinct()->pluck('city');

        if (!$hotelCity) {
            return ResponseFormatter::error(null, 'Data not found');
        }

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

        $hotels = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelImage', 'hotelRating');

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

            $imageUrl = '-';
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

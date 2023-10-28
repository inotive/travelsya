<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequestUpdate;
use App\Models\BookDate;
use App\Models\DetailTransaction;
use App\Models\DetailTransactionHostel;
use App\Models\Fee;
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
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
            $type_duration = $request->type_duration;
            if ($request->location != 'semua') {
                $hostels->where('city', 'like', '%' . $request->location . '%');
            }

//            if ($request->type_duration) {
//                $hostels->where('category', $request->type_duration);
//            }

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


                $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(price),0)'));
                }])->withCount(["rating as rating_avg" => function ($q) {
                    $q->select(DB::raw('coalesce(avg(rate),0)'));
                }])->withCount("rating as rating_count")->get();

                // dd($hostelsget);

                $hostelShow = $hostelsget->map(function ($hostelsget) use ($type_duration, $hostels) {
                    $hostelImage = $hostelsget->hostelImage->where('main', 1)->first();
                    $hostelRoom = $hostelsget->hostelRoom->where('hostel_id', $hostelsget->id)->first();

                    if ($type_duration == "monthly") {
                        $sellingPrice = $hostelRoom->where('hostel_id', $hostelsget->id)
                            ->orderBy('sellingrentprice_monthly','asc')
                            ->pluck('sellingrentprice_monthly')->first() ?? 0;
                    } elseif($type_duration == "yearly") {
                        $sellingPrice = $hostelRoom->where('hostel_id', $hostelsget->id)
                            ->orderBy('sellingrentprice_yearly','asc')
                            ->pluck('sellingrentprice_yearly')->first() ?? 0;
                    }
                    $avg_rating = $hostelsget->hostelRating->sum('rate') != 0 ? $hostelsget->hostelRating->sum('rate') / $hostelsget->hostelRating->count() : 0;
                    return [
                        'id' => $hostelsget->id,
                        'name' => $hostelsget->name,
                        'image' => $hostelImage ? asset('storage/media/hostel/' . $hostelImage->image) : null,
                        'location' => $hostelsget->city,
                        'avg_rating' => $avg_rating,
                        'rating_count' => $hostelsget->hostelRating->count(),
                        'sellingprice' => $sellingPrice,
                        'property_type' => $hostelsget->property,
                        'rent_category' => $type_duration,
                        'room_type' => $hostelRoom->roomtype,
                        'furnish_type' => $hostelRoom->furnish
                    ];
                });

                if (count($hostelShow)) {
                    return ResponseFormatter::success($hostelShow, 'Data successfully loaded');
                } else {
                    return ResponseFormatter::error(null, 'Data not found');
                }
            }
        catch
            (Exception $th) {
                return ResponseFormatter::error([$th->getMessage(), 'message' => 'Something wrong',], 'Hostel process failed', 500);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param Hostel $hostel
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            // $hostel = Hostel::find($hostel->id);
            $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating', 'hostelFacilities')->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(price),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")->findOrFail($id);
            $duration_type = $request->duration_type;
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
            $hostelGet = collect([$hostel])->map(function ($hostel) use ($duration_type) {
                $duration_type2 = $duration_type;
                $hostel_room = $hostel->hostelRoom->map(function ($room) use ($duration_type2) {

                    $hostel_room_image = $room->hostelRoomImage->map(function ($room_images) {
                        return ['id' => $room_images->id, 'hostel_room_id' => $room_images->hostel_room_id, 'hostel_room_name' => $room_images->hostelRoom->name, 'image' => 'storage/' . $room_images->image,];
                    });

                    $sellingPrice = 0;
                    if($duration_type2 == "monthly"){
                        $sellingPrice = $room->where('id', $room->id)
                            ->orderBy('sellingrentprice_monthly', 'asc')
                            ->pluck('sellingrentprice_monthly')->first();
                    }
                    else{
                        $sellingPrice = $room->where('id', $room->id)
                            ->orderBy('sellingrentprice_yearly', 'asc')
                            ->pluck('sellingrentprice_yearly')->first();
                    }
                    return [
                        'id' => $room->id,
                        'name' => $room->name,
                        'description' => $room->description,
                        'price' => $room->price,
                        'sellingprice' => $sellingPrice,
                        'bed_type' => $room->bed_type,
                        'roomsize' => $room->roomsize,
                        'maxextrabed' => $room->maxextrabed,
                        'totalroom' => $room->totalroom,
                        'guest' => $room->guest,
                        'hostel_room_image' => $hostel_room_image];
                });

                $hostel_rules = $hostel->hostelRule->map(function ($rule) {
                    return ['id' => $rule->id, 'description' => $rule->description,];
                });

                $hostel_reviews = null;
//                if ($hostel->rating != null) {
                    $hostel_reviews = $hostel->hostelRating->map(function ($reviews) {
                        return ['id' => $reviews->id,
                            'room' => $reviews->hostelRoom->name,
                            'user_id' => $reviews->users_id,
                            'user_name' => $reviews->user->name,
                            'rate' => $reviews->rate,
                            'comment' => $reviews->comment,
                            'deleted_at' => $reviews->deleted_at,
                            'created_at' => $reviews->created_at,
                            'updated_at' => $reviews->updated_at,];
                    });
//                }

                $hostelFacilities = $hostel->hostelFacilities->map(function ($facility) {
                    return [
                        // 'hotel_id' => $facility->hotel_id,
                        // 'hotel_room_id' => $facility->hotel_room_id,
                        'id' => $facility->facility_id,
                        'name' => $facility->facility->name,
                        'image' => 'storage/' . $facility->facility->icon,
                    ];
                });
                $avg_rating = $hostel->hostelRating->sum('rate') != 0 ? $hostel->hostelRating->sum('rate') / $hostel->hostelRating->count() : 0;

                return ['id' => $hostel->id,
                    'name' => $hostel->name,
                    'category' => $hostel->category,
                    'image' => 'storage/' . $hostel->image,
                    'checkin' => $hostel->checkin,
                    'checkout' => $hostel->checkout,
                    'location' => $hostel->city,
                    'address' => $hostel->address,
                    'lat' => $hostel->lat,
                    'lon' => $hostel->lon,
                    'avg_rating' => $avg_rating,
                    'rating_count' => $hostel->hostelRating->count(),
                    'hostel_image' => $hostel->hostelImage,
                    'hostel_rooms' => $hostel_room,
                    'hostel_facilities' => $hostelFacilities,
                    'hostel_rules' => $hostel_rules,
                    'hostel_reviews' => $hostel_reviews,];
            });

            if (count($hostelGet)) {
                return ResponseFormatter::success($hostelGet, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([$th, 'message' => 'Something wrong',], 'Hostel process failed', 500);
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
            return ResponseFormatter::error([$th->getMessage(), 'message' => 'Something wrong',], 'Hostel process failed', 500);
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
            "duration_type" => "required",
            "total_guest" => "required",
           ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['response' => $validator->errors(),], 'Hostel process failed', 500);
        }

        $data = $request->all();
        $hostel = HostelRoom::with('hostel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper('hostel') . "-" . time();


        //cekpoint
        $start = new DateTime($data['start']);
        $end = new DateTime($data['end']);
        $interval = $end->diff($start);
        $qty = $interval->format('%m');

        $amount = 0;
        if($request->duration_type == "monthly")
        {
            $amount = $hostel->sellingrentprice_monthly;
        }
        else{
            $amount = $hostel->sellingrentprice_yearly;
        }

        $fee = Fee::where('service_id', 7)->first();
        $fees = [
            [
                'type' => 'admin',
                'value' => $fee->percent == 0 ? $fee->value :   $amount * $fee->value / 100,
            ],
        ];

        // ceate xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hostel_room_id'],
                    "name" => $hostel['name'],
                    "price" => $amount,
                    "quantity" => $qty,
                ]
            ],
            'amount' => ($amount * $qty) + $fees[0]['value'] ,
            'success_redirect_url' => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' =>
                [
                    'given_names' => $data['guest'][0]['name'],
                    'email' => $data['guest'][0]['email'],
                    'mobile_number' => $data['guest'][0]['phone'] ?? "somenumber",
                ],
            'fees' => $fees
        ]);

        $storeTransaction = Transaction::create([
            'no_inv' => $invoice,
            'req_id' => 'HST-' . time(),
            'service' => 'hostel', // 'service_id' => $hostel->hostel->service_id,
            'service_id' => 7,
            'payment' => $data['payment'],
            'user_id' => \Auth::user()->id,
            'status' => $payoutsXendit['status'],
            'link' => $payoutsXendit['invoice_url'],
            'total' => ($amount * $qty) + $fees[0]['value']
        ]);

        DB::table('detail_transaction_hostel')
            ->insert([
                'transaction_id' => $storeTransaction->id,
                'hostel_id' => $hostel->hostel_id,
                'hostel_room_id' => $data['hostel_room_id'],
                'type_rent' => $request->duration_type,
                'booking_id' => Str::random(6),
                'reservation_start' => $data['start'],
                'reservation_end' => $data['end'],
                'guest' => $request->total_guest,
                'room' => 1, // "rent_price"        => $hostel->sellingprice,
                "rent_price" => $amount,
                "fee_admin" => $fees[0]['value']
            ]);

        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function hostelCity()
    {
        $hostelCity = Hostel::distinct()->pluck('city');

        if (!$hostelCity) return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hostelCity, 'Data successfully loaded');
    }

    public function hostelPopuler()
    {
        $hostelPopuler = Hostel::with('hostelImage', 'rating')->has("hostelRoom") //retrieve only hostel that have hostel room, to avoid data with 0 price_avg
        ->withCount(["hostelRoom as price_avg" => function ($q) {
            $q->select(DB::raw('coalesce(avg(price),0)'));
        }])->withCount(["rating as rating_avg" => function ($q) {
            $q->select(DB::raw('coalesce(avg(rate),0)'));
        }])->withCount("rating as rating_count")->orderBy('price_avg', "asc")->orderBy('rating_count', 'DESC')->orderBy('rating_avg', 'DESC')->get();
        $hostelFormatJSON = [];
        foreach ($hostelPopuler as $hostel) {
            $minPrice = $hostel->hostelRoom->min('price');
            $maxPrice = $hostel->hostelRoom->min('sellingprice');
            $jumlahTransaksi = $hostel->rating->count();
            $totalRating = $hostel->rating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating = $totalRating / $jumlahTransaksi;
            } else {
                $avgRating = 0;
            }
            $imageUrl = "-";
            //retrieve image url
            if (!$hostel->hostelImage->isEmpty()) {
                $imageUrl = $hostel->hostelImage[0]->image;
            }

            $hotelDetails[$hostel->id] = ['avg_rating' => $avgRating, 'rating_count' => $jumlahTransaksi, 'price' => $minPrice, 'sellingprice' => $maxPrice,];

            $hostelRoom = $hostel->hostelRoom->where('hostel_id', $hostel->id)->first();

            $hostelFormatJSON[] = ['id' => $hostel->id, 'name' => $hostel->name, 'image' => $imageUrl, 'location' => $hostel->city, 'rating_avg' => $hotelDetails[$hostel->id]['avg_rating'], 'rating_count' => $hotelDetails[$hostel->id]['rating_count'], 'sellingprice' => $hotelDetails[$hostel->id]['sellingprice'], 'property_type' => $hostel->property, 'rent_category' => $hostel->category, 'room_type' => $hostelRoom->roomtype, 'furnish_type' => $hostelRoom->furnish];

            usort($hostelFormatJSON, function ($a, $b) {
                // Mengurutkan berdasarkan avg_rating secara menurun (dari tertinggi ke terendah)
                $avgRatingComparison = $b['rating_avg'] - $a['rating_avg'];

                // Jika avg_rating sama, maka urutkan berdasarkan rating_count secara menurun
                if ($avgRatingComparison === 0) {
                    return $b['rating_count'] - $a['rating_count'];
                }

                return $avgRatingComparison;
            });
        }
        if (!$hostelPopuler) return ResponseFormatter::error(null, 'Data not found');


        return ResponseFormatter::success($hostelFormatJSON, 'Data successfully loaded');
    }
}

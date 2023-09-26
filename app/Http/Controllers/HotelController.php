<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Facility;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\HotelBookDate;
use App\Models\HotelRoom;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Travelsya;
use App\Services\Xendit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    protected $travelsya, $xendit;

    public function __construct(Travelsya $travelsya, Xendit $xendit)
    {
        $this->travelsya = $travelsya;
        $this->xendit = $xendit;
    }

    public function index(Request $request)
    {
        // $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');

        // if ($request->name)
        //     $hotels->where('name', 'like', '%' . $request->name . '%');

        // if ($request->location)
        //     $hotels->where('city', 'like', '%' . $request->location . '%');

        // $hotelsget = $hotels->withCount(["hotelRoom as price_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
        // }])->withCount(["hotelRating as rating_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(rate),0)'));
        // }])->withCount("hotelRating as rating_count")->get();

        // dd($hostelsget);
        // $cities = Hotel::distinct()->pluck('city');
        // $params = $request->all();
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->start);
        // $params['city'] = ($request->location) ?: '';
        // $params['name'] = ($request->name) ?: '';

        // return view('hotel.index', ['hotels' => $hotelsget, 'cities' => $cities, 'params' => $params]);


        // $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating')
        //     ->withAvg('hotelRating', 'rate')
        //     ->orderByDesc('hotel_rating_avg_rate');
        $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelFacilities')
            ->whereHas('hotelRoom', function ($query) use ($request) {
                $query->where([
                    ['totalroom', '>', $request->room],
                    ['guest', '>=', 3],
                ]);
            })
            ->where(function ($query) use ($request) {
                $query->where('hotels.city', 'like', '%' . $request->location . '%')
                    ->orWhere('hotels.name', 'like', '%' . $request->location . '%');
            })
            ->whereRaw('(
                SELECT SUM(totalroom) FROM hotel_rooms hr WHERE hr.hotel_id = hotels.id
            ) - (
                SELECT COALESCE(SUM(room), 0) FROM detail_transaction_hotel WHERE hotel_id = hotels.id
                AND ? <= guest
                AND ? >= reservation_start
            ) > 0', [$request->end_date, $request->start]);

        if ($request->has('harga')) {
            if ($request->harga == 'tertinggi') {
                $hotels->whereHas('hotelRoom', function ($query) use ($request) {
                    $query->orderByDesc('sellingprice');
                });
            }

            if ($request->harga == 'terendah') {
                $hotels->whereHas('hotelRoom', function ($query) use ($request) {
                    $query->orderBy('sellingprice');
                });
            }
        }

        if ($request->has('facility')) {
            $hotels->whereHas('hotelFacilities', function ($query) use ($request) {
                $query->where('facility_id', $request->facility);
            });
        }

        if ($request->has('star')) {
            $hotels->where('star', $request->star);
        }

        $hotels = $hotels->paginate(10);

        $hotelDetails = [];

        foreach ($hotels as $hotel) {
            $minPrice = $hotel->hotelRoom->min('sellingprice');
            $maxPrice = $hotel->hotelRoom->max('sellingprice');
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
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'total_rating' => $totalRating,
                'result_rating' => $resultRating,
                'star_rating' => floor($resultRating),
            ];
        }

        $data['hotels'] = $hotels;
        $data['hotelDetails'] = $hotelDetails;
        $data['request'] = $request->all();
        $data['facilities'] = Facility::all();
        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::all();
        $data['facilities'] = Facility::all();

        // dd($hotels);
        // dd($hotelPrices);
        return view('hotel.list-hotel', $data);
    }

    public function listHotel()
    {
        return view('hotel.list-hotel');
    }

    public function room(Request $request, $id_hotel)
    {
        //        $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating');
        //        $params['location'] = ($request->location) ?: '';
        //        $params['start_date'] = strtotime($request->start);
        //        $params['end_date'] = strtotime($request->end);
        //        $params['room'] = ($request->room) ?: '';
        //        $params['guest'] = ($request->guest) ?: '';
        //        $params['property'] = ($request->property) ?: '';
        //        $params['roomtype'] = ($request->roomtype) ?: '';
        //        $params['furnish'] = ($request->furnish) ?: '';
        //        $params['name'] = ($request->name) ?: '';
        //        $cities = Hotel::distinct()->pluck('city');
        //
        //        $hotelget = $hotel->withCount(["hotelRoom as price_avg" => function ($q) {
        //            $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
        //        }])->withCount(["hotelRoom as minprice" => function ($q) {
        //            $q->select(DB::raw('min(sellingprice)'));
        //        }])->withCount(["hotelRoom as maxprice" => function ($q) {
        //            $q->select(DB::raw('max(sellingprice)'));
        //        }])->withCount(["hotelRating as rating_avg" => function ($q) {
        //            $q->select(DB::raw('coalesce(avg(rate),0)'));
        //        }])->withCount("hotelRating as rating_count")->find($id);

        //        return view('hotel.show', compact('hotelget', 'params', 'cities'));


        $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating')
            ->findOrFail($id_hotel);

        $minPrice = $hotel->hotelRoom->min('sellingprice');
        $maxPrice = $hotel->hotelRoom->max('sellingprice');
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

        $data['request'] = $request->all();
        $data['detailHotel'] = $hotel;
        $data['min_price'] = $minPrice;
        $data['max_price'] = $maxPrice;
        $data['total_rating'] = $totalRating;
        $data['result_rating'] = $resultRating;
        $data['star_rating'] = floor($resultRating);

        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::all();

        // dd($data['hotel']);

        return view('hotel.show', $data);
    }

    public function reservationExample()
    {
        return view('reservation.index');
    }

    public function reservation(Request $request, $idroom)
    {
        // $hotelRoom = HotelRoom::with(['hotel' => function ($q1) {
        //     $q1->withCount(["hotelRating as rating_avg" => function ($q) {
        //         $q->select(DB::raw('coalesce(avg(rate),0)'));
        //     }]);
        // }], 'hotelBookDate')->find($idroom);

        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = date('d-m-Y', strtotime("+" . $request->duration . " days", strtotime($request->start)));
        // $params['room'] = ($request->room) ?: '';
        // $params['guest'] = ($request->guest) ?: '';
        // $params['duration'] = ($request->duration) ?: '';
        // dd($hotelRoom);
        // return view('hotel.reservation', compact('hotelRoom', 'params'));


        $hotelRoom = HotelRoom::with('hotel')->findOrFail($idroom);

        // $minPrice = $hotel->hotelRoom->min('sellingprice');
        // $maxPrice = $hotel->hotelRoom->max('sellingprice');
        // $jumlahTransaksi = $hotel->hotelRating->count();
        // $totalRating = $hotel->hotelRating->sum('rate');

        // // Rating 5
        // if ($jumlahTransaksi > 0) {
        //     $avgRating = $totalRating / $jumlahTransaksi;
        //     $resultRating = ($avgRating / 10) * 5;
        // } else {
        //     $avgRating = 0;
        //     $resultRating = 0;
        // }

        $data['params'] = $request->all();
        $data['hotelRoom'] = $hotelRoom;
        $point = new Point;
        $data['point'] = $point->cekPoint(auth()->user()->id);
        // $data['min_price'] = $minPrice;
        // $data['max_price'] = $maxPrice;
        // $data['total_rating'] = $totalRating;
        // $data['result_rating'] = $resultRating;
        // $data['star_rating'] = floor($resultRating);


        return view('hotel.reservation', $data);
    }

    public function request(Request $request)
    {
        // $data = $request->all();

        // $hotel = $this->travelsya->requestHotel([
        //     "service" => $data['service'],
        //     "payment" => $data['payment_method'],
        //     "hotel_room_id" => $data['hostel_room_id'],
        //     "point" => 0,
        //     "guest" => [
        //         [
        //             "type_id" => "KTP",
        //             "identity" => 123456,
        //             "name" => $data['name']
        //         ]
        //     ],
        //     "start" => $data['start'],
        //     "end" => $data['end'],
        //     "url" => "linkproduct"

        // ]);

        // dd($data);

        // if ($hotel['meta']['code'] != 200) {
        //     toast($hotel['meta']['message'], 'error');
        //     return redirect()->back();
        // }

        // return redirect()->to($hotel['data']['invoice_url'])->send();

        $data = $request->all();

        // dd($data);
        $hotel = HotelRoom::with('hotel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($hotel->hotel->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $hotel->hotel->service_id, $request->user()->id, $hotel->sellingprice);

        //cekpoint
        // if (!$fees) return ResponseFormatter::error(null, 'Point invalid');
        // $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days) - 1 ?: 1;
        // if ($qty < 0) return ResponseFormatter::error(null, 'Date must be forward');
        // $amount = $setting->getAmount($hotel->sellingprice, $qty, $fees);
        if (!$fees) return 'Point invalid';
        $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days);
        if ($qty < 0) return 'Date must be forward';
        $amount = $setting->getAmount($hotel->sellingprice, $qty, $fees, $data['room']);

        // dd($data);

        // cek book date
        $checkBook = HotelBookDate::where("hotel_room_id", $data['hostel_room_id'])->where('start', '>=', $data['start'])->where('end', "<=", $data['end'])->first();

        // if ($checkBook) {
        //     return ResponseFormatter::error($checkBook, 'Book dates is not available');
        // }

        // ceate xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hostel_room_id'],
                    "name" => $hotel['name'],
                    "price" => $hotel->sellingprice,
                    "quantity" => $qty,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url'  => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
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
                // 'payment' => $payoutsXendit['payment'],
                'payment' => 'xendit',
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount
            ]);


            // true buat detail
            $storeDetailTransaction = DetailTransaction::create([
                'transaction_id' => $storeTransaction->id,
                'hotel_room_id' => $data['hostel_room_id'],
                "qty" => $qty,
                "price" => $hotel->sellingprice
            ]);


            // true buat bookdate
            $storeBookDate = HotelBookDate::create([
                'start' => date_create($data['start']),
                'end' => date_create($data['end']),
                'hotel_room_id' => $data["hostel_room_id"],
                'transaction_id' => $storeTransaction->id
            ]);

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

            if ($data['point']) {
                //deductpoint
                $point = new Point;
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $storeTransaction->id);
            }
        });

        return redirect($payoutsXendit['invoice_url']);


        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function ajaxCity()
    {
        $hotelCity = Hotel::distinct()->select('city')->get();

        return response()->json(($hotelCity));
    }
    // public function indexAgil(Request $request)
    // {
    //     $hotels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '']);
    //     $cities = $this->travelsya->hostelCity();
    //     $date = explode(" ", $request->date);
    //     $params = $request->all();
    //     $params['start_date'] = $request->date ? strtotime($date[0]) : null;
    //     $params['end_date'] = $request->date ? strtotime($date[2]) : null;
    //     $params['city'] = ($request->location) ?: '';
    //     $params['name'] = ($request->name) ?: '';

    //     return view('hotel.index', ['hotels' => $hotels['data'], 'cities' => $cities['data'], 'params' => $params]);
    // }

    public function favoriteHotel()
    {
        $hotels = Hotel::with('hotelRoom', 'hotelRating')->get();

        // Hitung total rating untuk setiap hotel dan simpan dalam array asosiatif
        $hotelRatings = [];

        foreach ($hotels as $ratingHotel) {
            $totalRating = $ratingHotel->hotelRating->sum('rate');
            $hotelRatings[$ratingHotel->id] = $totalRating;
        }

        // Urutkan hotel berdasarkan jumlah total rating terbesar
        arsort($hotelRatings);

        // Ambil ID hotel yang diurutkan
        $sortedHotelIds = array_keys($hotelRatings);

        // Ambil data hotel dengan urutan rating terbesar
        $favoriteHotels = Hotel::with('hotelRoom', 'hotelRating')
            ->whereIn('id', $sortedHotelIds)
            ->limit(4)
            ->get();

        // Inisialisasi array kosong untuk data hotel yang diformat
        $formattedHotels = [];

        // // Loop melalui setiap hotel
        foreach ($favoriteHotels as $hotel) {
            $formattedHotel = [
                'id' => $hotel->id,
                'label' => $hotel->name,
                'city' => $hotel->city,
                'image' => $hotel->hotelRoom[0]->image_1, // Misalnya, mengambil gambar dari kamar pertama
                'price' => number_format($hotel->hotelRoom[0]->price, 0, ',', '.'), // Misalnya, mengambil harga dari kamar pertama
                'realPrice' => number_format($hotel->hotelRoom[0]->sellingprice, 0, ',', '.'), // Misalnya, mengambil harga jual dari kamar pertama
                'rate' => $hotel->star,
                'totalRate' => $hotel->hotelRating->count(),
            ];

            // Tambahkan data hotel yang diformat ke dalam array formattedHotels
            $formattedHotels[] = $formattedHotel;
        }

        return response()->json($formattedHotels);
    }
}

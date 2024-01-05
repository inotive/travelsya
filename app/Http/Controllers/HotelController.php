<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Product;
use App\Services\Point;
use App\Helpers\General;
use App\Models\Facility;
use App\Services\Xendit;
use App\Models\HotelRoom;
use App\Services\Setting;
use App\Models\Transaction;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use App\Models\HotelBookDate;
use App\Models\DetailTransaction;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailTransactionHotel;
use App\Models\HotelRating;

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
        $hotels = Hotel::where('hotels.is_active', 1)->with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelroomFacility')
            ->whereHas('hotelRoom', function ($query) use ($request) {
                $query->where(
                    'totalroom',
                    '>=',
                    $request->room,
                );
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
        if ($request->has('facility')) {
            $hotels->whereHas('hotelroomFacility', function ($query) use ($request) {
                $query->whereIn('facility_id', $request->facility);
            });
        }

        if ($request->has('star')) {
            $hotels->whereIn('star', $request->star);
        }

        if ($request->has('harga')) {
            $orderDirection = $request->harga === 'tertinggi' ? 'desc' : 'asc';

            $hotels->select('hotels.*', DB::raw('MIN(hotel_rooms.sellingprice) as min_price'))
                ->leftJoin('hotel_rooms', 'hotel_rooms.hotel_id', '=', 'hotels.id')
                ->groupBy('hotels.id')
                ->orderBy('min_price', $orderDirection);
        }


        $hotels = $hotels->paginate(10)->appends(request()->query());
        $hotelDetails = [];

        foreach ($hotels as $hotel) {
            $minPrice        = $hotel->hotelRoom->min('sellingprice');
            $maxPrice        = $hotel->hotelRoom->max('sellingprice');
            $jumlahTransaksi = $hotel->hotelRating->count();
            $totalRating     = $hotel->hotelRating->sum('rate');

            // Rating 5
            if ($jumlahTransaksi > 0) {
                $avgRating    = $totalRating / $jumlahTransaksi;
                $resultRating = ($avgRating / 10) * 5;
            } else {
                $avgRating    = 0;
                $resultRating = 0;
            }

            $hotelDetails[$hotel->id] = [
                'min_price'     => $minPrice,
                'max_price'     => $maxPrice,
                'total_rating'  => $totalRating,
                'result_rating' => $resultRating,
                'star_rating'   => floor($resultRating),
            ];
        }

        $data['hotels']       = $hotels;
        $data['hotelDetails'] = $hotelDetails;
        $data['request'] = $request->all();
        $data['facilities'] = Facility::all();
        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::where('is_active', 1)->get();

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


        $hotel = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelImage', 'hotelRating')
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

        $ratings  = DB::table('hotel_ratings')->join('users', 'hotel_ratings.users_id', '=', 'users.id')
            ->where('hotel_id', $id_hotel)
            ->select('hotel_ratings.*', 'hotel_ratings.created_at as created' , 'users.*')
            ->limit(30)
            ->get();
        
        Carbon::setLocale('id');
        // $formatted_created_at = null;

        if ($ratings ->isNotEmpty()) {
            // Menggunakan first() untuk mendapatkan satu baris hasil
            $rating = $ratings->first();
            // $data['formatted_created_at'] = Carbon::parse($rating->created_at)->diffForHumans();
        }

        $data['avg_rate'] = $ratings->avg('rate');
        
        $data['rating'] = $ratings;

        $data['request'] = $request->all();
        $data['detailHotel'] = $hotel;
        $data['min_price'] = $minPrice;
        $data['max_price'] = $maxPrice;
        $data['total_rating'] = $totalRating;
        $data['result_rating'] = $resultRating;
        $data['star_rating'] = floor($resultRating);

        $data['ewallets'] = Product::where('is_active', 1)
            ->where('category', 'ewallet')
            ->where('service_id', 11)
            ->distinct('name')
            ->pluck('name');

        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::where('is_active', 1)->get();

        return view('hotel.show', $data);
    }

    public function reservationExample()
    {
        return view('reservation.index');
    }

    public function reservation(Request $request, $idroom)
    {
        $hotelRoom = HotelRoom::with('hotel')->findOrFail($idroom);

        $data['params'] = $request->all();
        $data['hotelRoom'] = $hotelRoom;

        $point = new Point;
        $data['point'] = $point->cekPoint(auth()->user()->id);

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], 8, $request->user()->id, $hotelRoom->sellingprice);

        $data['uniqueCode'] = rand(111, 999);
        $data['grandTotal'] = $hotelRoom->sellingprice + $fees[0]['value'] + $data['uniqueCode'];
        $data['feeAdmin'] = $fees[0]['value'];

        return view('hotel.reservation', $data);
    }

    public function request(Request $request)
    {
        // dd($request->point);
        $data = $request->all();
        $hotel = HotelRoom::with('hotel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-Hotel-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['pointFee'], 8, $request->user()->id, $hotel->sellingprice);

        // $uniqueCode = rand(111, 999);
        $fees[] = [
            'type' => 'Kode Unik',
            'value' => $data['uniqueCode'],
        ];

        //cekpoint
        // if (!$fees) return ResponseFormatter::error(null, 'Point invalid');
        // $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days) - 1 ?: 1;
        // if ($qty < 0) return ResponseFormatter::error(null, 'Date must be forward');
        // $amount = $setting->getAmount($hotel->sellingprice, $qty, $fees);
        if (!$fees) return 'Point invalid';
        $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days);
        if ($qty < 0) return 'Date must be forward';
        $sellingPrice = $request->point == null ? $hotel->sellingprice : $hotel->sellingprice - $request->point;
        $amount = $setting->getAmount($sellingPrice, $qty, $fees, $data['room']);

        // cek book date
        $checkBook = DetailTransactionHotel::where("hotel_room_id", $data['hostel_room_id'])
            ->where('reservation_start', '>=', $data['start'])
            ->where('reservation_end', "<=", $data['end'])->first();

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
                    "price" =>  $hotel->sellingprice,
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

            // dd($uniqueCode);
            $storeTransaction = Transaction::create([
                'no_inv'     => $invoice,
                'req_id'     => 'HTL-' . time(),
                'service'    => 'HOTEL',
                'service_id' => 8,
                // 'payment' => $payoutsXendit['payment'],
                'payment' => 'xendit',
                'user_id' => $request->user()->id,
                'status'  => $payoutsXendit['status'],
                'link'    => $payoutsXendit['invoice_url'],
                'total'   => $amount
            ]);

            $helper = new General();
            // true buat detail

            $storeDetailTransaction = DetailTransactionHotel::create([
                'transaction_id'    => $storeTransaction->id,
                'hotel_id'          => $data['hotel_id'],
                'hotel_room_id'     => $data['hostel_room_id'],
                "booking_id"        => $helper->generateRandomString(6),
                "reservation_start" => Carbon::parse($data['start'])->format('Y-m-d'),
                "reservation_end"   => Carbon::parse($data['end'])->format('Y-m-d'),
                "guest"             => $data['total_guest'],
                "room"              => $data['room'],
                "rent_price"        => $hotel->sellingprice,
                "fee_admin"         => $fees[0]['value'],
                "kode_unik"         => $data['uniqueCode'],
                "guest_name"         => $data['nama_lengkap'],
                "guest_email"         => $data['email'],
                "guest_handphone"         => $data['no_telfon'],
                "created_at"        => Carbon::now(),
            ]);

            //            if ($data['point']) {
            //                //deductpoint
            //                $point = new Point;
            //                $point->deductPoint($request->user()->id, abs($fees[0]['value']), $storeTransaction->id);
            //            }
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
        $hotels = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelRating')->get();

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
        $favoriteHotels = Hotel::where('is_active', 1)->with('hotelRoom', 'hotelRating')
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

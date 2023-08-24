<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
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
        $hotels = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating')
            ->whereHas('hotelRoom', function ($query) use ($request) {
                $query->where('totalroom', '>', $request->room)
                    ->where('guest', '>=', 3);
            })->where(function ($query) use ($request) {
                $query->where('city', 'like', '%' . $request->location . '%')
                    ->orWhere('name', 'like', '%' . $request->location . '%');
            })->get();

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
        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::all();

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
        $data['hotel'] = $hotel;
        $data['min_price'] = $minPrice;
        $data['max_price'] = $maxPrice;
        $data['total_rating'] = $totalRating;
        $data['result_rating'] = $resultRating;
        $data['star_rating'] = floor($resultRating);

        $data['citiesHotel'] = Hotel::distinct()->select('city')->get();
        $data['listHotel'] = Hotel::all();

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
        // $data['min_price'] = $minPrice;
        // $data['max_price'] = $maxPrice;
        // $data['total_rating'] = $totalRating;
        // $data['result_rating'] = $resultRating;
        // $data['star_rating'] = floor($resultRating);

        return view('hotel.reservation', $data);
    }

    public function request(Request $request)
    {
        $data = $request->all();
        // dd($request->all());
        $hotel = $this->travelsya->requestHotel([
            "service" => $data['service'],
            "payment" => $data['payment_method'],
            "hotel_room_id" => $data['hostel_room_id'],
            "point" => 0,
            "guest" => [[
                "type_id" => "KTP",
                "identity" => 123456,
                "name" => $data['name']
            ]],
            "start" => $data['start'], //"2023-08-13"
            "end" => $data['end'],
            "url" => "linkproduct"

        ]);
        if ($hotel['meta']['code'] != 200) {
            toast($hotel['meta']['message'], 'error');
            return redirect()->back();
        }

        return redirect()->to($hotel['data']['invoice_url'])->send();
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
}

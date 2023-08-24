<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HostelController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function index(Request $request)
    {
        // $hostels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '', 'category' => ($request->category) ?: '']);
        // $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
        // if ($request->name)
        //     $hostels->where('name', 'like', '%' . $request->name . '%');

        // if ($request->location)
        //     $hostels->where('city', 'like', '%' . $request->location . '%');

        // if ($request->category)
        //     $hostels->where('category', 'like', '%' . $request->category . '%');

        // if ($request->property)
        //     $hostels->where('property', $request->property);

        // if ($request->furnish) {
        //     $furnish = $request->furnish;
        //     $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
        //         $q->where('furnish', $furnish);
        //     });
        // }

        // if ($request->roomtype) {
        //     $roomtype = $request->roomtype;
        //     $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
        //         $q->where('roomtype', $roomtype);
        //     });
        // }

        // $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
        // }])->withCount(["rating as rating_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(rate),0)'));
        // }])->withCount("rating as rating_count")->get();
        // // dd($hostelsget);
        // $cities = Hostel::distinct()->pluck('city');
        // $params = $request->all();
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->end);
        // $params['category'] = ($request->category) ?: '';
        // $params['name'] = ($request->name) ?: '';

        // return view('hostel.index', ['hostels' => $hostelsget, 'cities' => $cities, 'params' => $params]);

        $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating')
            ->where('city', 'like', '%' . $request->location . '%')
            ->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")
            ->get();

        // $hostelDetails = [];

        // foreach ($hostels as $hostel) {
        //     $minPrice = $hostel->hostelRoom->min('sellingprice');
        //     $maxPrice = $hostel->hostelRoom->max('sellingprice');
        //     $jumlahTransaksi = $hostel->hostelRating->count();
        //     $totalRating = $hostel->hostelRating->sum('rate');

        //     // Rating 5
        //     if ($jumlahTransaksi > 0) {
        //         $avgRating = $totalRating / $jumlahTransaksi;
        //         $resultRating = ($avgRating / 10) * 5;
        //     } else {
        //         $avgRating = 0;
        //         $resultRating = 0;
        //     }

        //     $hostelDetails[$hostel->id] = [
        //         'min_price' => $minPrice,
        //         'max_price' => $maxPrice,
        //         'total_rating' => $totalRating,
        //         'result_rating' => $resultRating,
        //         'star_rating' => floor($resultRating),
        //     ];
        // }

        // $data['hostelDetails'] = $hostelDetails;
        $data['hostels'] = $hostels;
        $data['params']  = $request->all();
        $data['cities']  = Hostel::distinct()->pluck('city');

        return view('hostel.index', $data);
    }

    public function room($id, Request $request)
    {
        // $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating');
        // $params['location'] = ($request->location) ?: '';
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->end);
        // $params['room'] = ($request->room) ?: '';
        // $params['guest'] = ($request->guest) ?: '';
        // $params['property'] = ($request->property) ?: '';
        // $params['roomtype'] = ($request->roomtype) ?: '';
        // $params['furnish'] = ($request->furnish) ?: '';
        // $params['name'] = ($request->name) ?: '';
        // $cities = Hostel::distinct()->pluck('city');

        // $hostelget = $hostel->withCount(["hostelRoom as price_avg" => function ($query) {
        //     $query->select(DB::raw('coalesce(avg(sellingprice),0)'));
        // }])
        //     ->withCount(["rating as rating_avg" => function ($query) {
        //         $query->select(DB::raw('coalesce(avg(rate),0)'));
        //     }])
        //     ->withCount("rating as rating_count")
        //     ->find($id);

        // return view('hostel.room', compact('hostelget', 'params', 'cities'));

        $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating');

        $data['hostelget'] = $hostel->withCount(["hostelRoom as price_avg" => function ($query) {
            $query->select(DB::raw('coalesce(avg(sellingprice),0)'));
        }])
            ->withCount(["rating as rating_avg" => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])
            ->withCount("rating as rating_count")
            ->find($id);

        $params['location'] = ($request->location) ?: '';
        $params['start_date'] = strtotime($request->start);
        $params['end_date'] = strtotime($request->end);
        $params['room'] = ($request->room) ?: '';
        $params['guest'] = ($request->guest) ?: '';
        $params['property'] = ($request->property) ?: '';
        $params['roomtype'] = ($request->roomtype) ?: '';
        $params['furnish'] = ($request->furnish) ?: '';
        $params['name'] = ($request->name) ?: '';

        $data['params'] = $params;
        $data['cities'] = Hostel::distinct()->pluck('city');

        return view('hostel.room', $data);
    }

    public function checkout($id, Request $request)
    {
        $hostelRoom = HostelRoom::with('hostel', 'bookDate')->find($id);
        $params['start_date'] = strtotime($request->start);
        $params['end_date'] = ($request->room) ?: '';
        $params['guest'] = ($request->guest) ?: '';
        $params['duration'] =  date('d-m-Y', strtotime("+" . $request->duration . " month", strtotime($request->start)));
        $params['room'] = ($request->duration) ?: '';
        $params['duration'] = ($request->duration) ?: '';
        return view('hostel.checkout', compact('hostelRoom', 'params'));
    }

    public function request(Request $request)
    {
        $data = $request->all();
        // dd($request->all());
        $hostel = $this->travelsya->requestHostel([
            "service" => $data['service'],
            "payment" => $data['payment_method'],
            "hostel_room_id" => $data['hostel_room_id'],
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
        if ($hostel['meta']['code'] != 200) {
            toast($hostel['meta']['message'], 'error');
            return redirect()->back();
        }

        return redirect()->to($hostel['data']['invoice_url'])->send();
    }

    public function ajaxHostel(Request $request)
    {
        try {
            $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
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
            $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")->get();

            $hostelsCollect = collect($hostelsget);
            if ($request->optionsort == 'highestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'desc']])->values();

            if ($request->optionsort == 'lowestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'asc']])->values();

            if ($request->optionsort == 'review')
                $hotstelFIlter = $hostelsCollect->sortBy([['rating_avg', 'desc']])->values();

            if ($request->optionrate  != null) {
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

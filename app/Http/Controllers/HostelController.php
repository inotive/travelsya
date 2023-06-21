<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
        if ($request->name)
            $hostels->where('name', 'like', '%' . $request->name . '%');

        if ($request->location)
            $hostels->where('city', 'like', '%' . $request->location . '%');

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
            $q->select(DB::raw('coalesce(avg(price),0)'));
        }])->withCount(["rating as rating_avg" => function ($q) {
            $q->select(DB::raw('coalesce(avg(rate),0)'));
        }])->withCount("rating as rating_count")->get();

        $cities = Hostel::distinct()->pluck('city');
        $params = $request->all();
        $params['start_date'] = strtotime($request->start);
        $params['end_date'] = strtotime($request->end);
        $params['category'] = ($request->category) ?: '';
        $params['name'] = ($request->name) ?: '';

        return view('hostel.index', ['hostels' => $hostelsget, 'cities' => $cities, 'params' => $params]);
    }

    public function ajaxHostel(Request $request)
    {
        try {
            $hostels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '', 'category' => ($request->category) ?: '']);
            $hostelsCollect = collect($hostels['data']);
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

<?php

namespace App\Http\Controllers;

use App\Services\Travelsya;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function index(Request $request)
    {
        $hostels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '', 'category' => ($request->category) ?: '']);
        $cities = $this->travelsya->hostelCity();
        $date = explode(" ", $request->date);
        $params = $request->all();
        $params['start_date'] = strtotime($date[0]);
        $params['end_date'] = strtotime($date[2]);
        $params['category'] = ($request->category) ?: '';
        $params['name'] = ($request->name) ?: '';

        return view('hostel.index', ['hostels' => $hostels['data'], 'cities' => $cities['data'], 'params' => $params]);
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
}

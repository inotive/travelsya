<?php

namespace App\Http\Controllers;

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

        return view('hotel.index');
    }

    public function show()
    {
        return view('hotel.show');
    }

    public function indexAgil(Request $request)
    {
        $hotels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '']);
        $cities = $this->travelsya->hostelCity();
        $date = explode(" ", $request->date);
        $params = $request->all();
        $params['start_date'] = $request->date ? strtotime($date[0]) : null;
        $params['end_date'] = $request->date ? strtotime($date[2]) : null;
        $params['category'] = ($request->category) ?: '';
        $params['name'] = ($request->name) ?: '';

        return view('hotel.index', ['hotels' => $hotels['data'], 'cities' => $cities['data'], 'params' => $params]);
    }
}

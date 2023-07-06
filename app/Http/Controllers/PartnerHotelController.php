<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Travelsya;

class PartnerHotelController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }
    
    public function index()
    {
        // $hostelPopulers = $this->travelsya->hostelPopuler();
        // $cities = $this->travelsya->hostelCity();
        // $ads = $this->travelsya->ads();
        // return view('home', ['hostelPopulers' => $hostelPopulers['data'], 'cities' => $cities['data'], 'ads' => $ads['data']]);
        return view('partner');
    }
}

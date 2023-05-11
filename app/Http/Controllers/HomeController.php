<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Travelsya;


class HomeController extends Controller
{
    protected $travelsya;
    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }
    public function home()
    {
        $hostelPopulers = $this->travelsya->hostelPopuler();
        $cities = $this->travelsya->hostelCity();

        return view('home', ['hostelPopulers' => $hostelPopulers['data'], 'cities' => $cities['data']]);
    }
}

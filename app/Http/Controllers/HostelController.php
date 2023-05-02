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

    public function index()
    {
        $hostelPopulers = $this->travelsya->hostelPopuler();
        $cities = $this->travelsya->hostelCity();

        return view('hostel.index', ['hostelPopulers' => $hostelPopulers['data'], 'cities' => $cities['data']]);
    }
}

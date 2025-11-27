<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\City;
use App\Models\CategoryRecreation;
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

        // Ambil user dengan role = 1 (mitra) beserta relasi yang relevan untuk menghindari N+1 problem
        $partners = User::where('role', 1)
            ->with(['hotel', 'hostel', 'clinic', 'rentals', 'recreations', 'bus_travels'])
            ->get();

        // Ambil data dari berbagai modul yang terkait dengan mitra
        $hotels = [];
        $hostels = [];
        $clinics = [];
        $rentals = [];
        $recreations = [];
        $busTravels = [];

        foreach ($partners as $partner) {
            // Tambahkan data jika relasi tersedia (bisa berupa collection atau model tunggal)
            if ($partner->hotel) {
                foreach ($partner->hotel as $hotel) {
                    $hotels[] = $hotel->toArray();
                }
            }
            if ($partner->hostel) {
                foreach ($partner->hostel as $hostel) {
                    $hostels[] = $hostel->toArray();
                }
            }
            if ($partner->clinic) {
                $clinics[] = $partner->clinic->toArray();
            }
            if ($partner->rentals) {
                foreach ($partner->rentals as $rental) {
                    $rentals[] = $rental->toArray();
                }
            }
            if ($partner->recreations) {
                foreach ($partner->recreations as $recreation) {
                    $recreations[] = $recreation->toArray();
                }
            }
            if ($partner->bus_travels) {
                foreach ($partner->bus_travels as $busTravel) {
                    $busTravels[] = $busTravel->toArray();
                }
            }
        }

        $data['partners'] = $partners;
        $data['hotels'] = $hotels;
        $data['hostels'] = $hostels;
        $data['clinics'] = $clinics;
        $data['rentals'] = $rentals;
        $data['recreations'] = $recreations;
        $data['busTravels'] = $busTravels;
        $data['ewallets'] = Product::where('is_active', 1)
            ->where('category', 'ewallet')
            ->get();
        $data['recreation_city'] = City::whereHas('recreations')->get();
        $data['category_recreation'] = CategoryRecreation::get();

        return view('partner', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\City;
use App\Models\CategoryRecreation;
use App\Models\Clinic;
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
            ->with([
                'hotel' => function($query) {
                    $query->where('is_active', 1);
                },
                'hostel' => function($query) {
                    $query->where('is_active', 1);
                },
                'rentals',
                'recreations' => function($query) {
                    $query->with(['image']); // Load the image relationship
                },
                'bus_travels' // BusTravels has image field directly in the model
            ])
            ->get();

        // Ambil klinik aktif secara langsung dari model Clinic
        $clinicsData = Clinic::where('is_active', 1)
            ->whereHas('user', function($query) {
                $query->where('role', 1);
            })
            ->with(['user', 'image'])  // Ambil relasi 'image' (hasOne) untuk gambar utama
            ->get();

        // Ambil data dari berbagai modul yang terkait dengan mitra, tanpa toArray() agar relasi tetap bisa diakses
        $hotels = collect(); // Gunakan collection untuk memudahkan penggabungan
        $hostels = collect();
        $clinics = collect();
        $rentals = collect();
        $recreations = collect();
        $busTravels = collect();

        foreach ($partners as $partner) {
            // Tambahkan data jika relasi tersedia (bisa berupa collection atau model tunggal)
            if ($partner->hotel) {
                $hotels = $hotels->concat($partner->hotel);
            }
            if ($partner->hostel) {
                $hostels = $hostels->concat($partner->hostel);
            }
            // Jangan ambil rental dari relasi user karena sudah diambil dari model CarRental langsung
            if ($partner->recreations) {
                $recreations = $recreations->concat($partner->recreations);
            }
            if ($partner->bus_travels) {
                $busTravels = $busTravels->concat($partner->bus_travels);
            }
        }

        // Tambahkan data klinik
        foreach ($clinicsData as $clinic) {
            // Tambahkan informasi user ke klinik agar bisa mengakses email dan kontak
            $clinic->user_email = $clinic->user->email;
            $clinic->user_phone = $clinic->user->phone;
            $clinics = $clinics->concat(collect([$clinic]));
        }

        // Ambil rental mobil aktif secara langsung dari model CarRental
        $rentalData = \App\Models\CarRental::where('is_active', 1)
            ->whereHas('user', function($query) {
                $query->where('role', 1);
            })
            ->with(['user'])
            ->get();

        // Tambahkan data rental mobil
        foreach ($rentalData as $rental) {
            // Tambahkan informasi user ke rental agar bisa mengakses email dan kontak
            $rental->user_email = $rental->user->email;
            $rental->user_phone = $rental->user->phone;
            $rentals = $rentals->concat(collect([$rental]));
        }

        // Konversi collection ke array di akhir jika diperlukan view, atau ubah view untuk menangani collection
        $data['partners'] = $partners;
        $data['hotels'] = $hotels; // Kirim collection ke view
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

<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\CarRental;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementCarRentalController extends Controller
{
    public function semuaRentalMobil()
    {
        $carRentals = CarRental::with('kota')->where('user_id', Auth::id())->get();
        return view('ekstranet.kendaraaan.semua-rental-mobil', compact('carRentals'));
    }

    public function profilRentalMobil($id)
    {
        $carRental = CarRental::findOrFail($id);
        $cities = City::all();
        return view('ekstranet.kendaraaan.profil-rental-mobil', compact('carRental', 'cities'));
    }

    public function updateProfilRentalMobil(Request $request, $id)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|exists:cities,city_id',
            'kebijakan_rental_mobil' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $carRental = CarRental::findOrFail($id);
        $carRental->update($request->only(['business_name', 'phone', 'address', 'city', 'kebijakan_rental_mobil', 'is_active']));

        return redirect()->route('partner.car_rental.all')->with('success', 'Profil rental mobil berhasil diperbarui.');
    }
}

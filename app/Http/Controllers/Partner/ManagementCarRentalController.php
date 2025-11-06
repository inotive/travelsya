<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\CarRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementCarRentalController extends Controller
{
    public function semuaRentalMobil()
    {
        $carRentals = CarRental::where('user_id', Auth::id())->get();
        return view('ekstranet.kendaraaan.semua-rental-mobil', compact('carRentals'));
    }

    public function profilRentalMobil($id)
    {
        $carRental = CarRental::findOrFail($id);
        return view('ekstranet.kendaraaan.profil-rental-mobil', compact('carRental'));
    }

    public function updateProfilRentalMobil(Request $request, $id)
    {
        $carRental = CarRental::findOrFail($id);
        $carRental->update($request->all());

        return redirect()->route('partner.car_rental.all')->with('success', 'Profil rental mobil berhasil diperbarui.');
    }
}

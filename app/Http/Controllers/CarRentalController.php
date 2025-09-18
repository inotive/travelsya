<?php

namespace App\Http\Controllers;

use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use Illuminate\Http\Request;

class CarRentalController extends Controller
{
    public function index(Request $request)
    {
        $tanggalRental = $request->input('tanggal-rental');
        $durasiRental = $request->input('durasi-rental');
        $ambilRental = $request->input('ambil-rental');
        $jamRental = $request->input('jam-rental');

        $query = CarRentalHasCars::query();

        // Filter berdasarkan kategori
        if ($request->input('category') !== null) {
            $query->where('category', $request->input('category'));
        }

        $cars = $query->with(['brand', 'carRental'])->get();
        $categories = CarRentalHasCars::select('category')->distinct()->get();
        
        // Mengambil data carRental untuk digunakan di view
        $carRental = CarRental::all();

        return view('rental-mobil.list-rental-mobil', compact('tanggalRental', 'durasiRental', 'ambilRental', 'jamRental', 'cars', 'categories', 'carRental'));
    }

    public function halamanRental(Request $request)
    {
        $tanggalRental = $request->input('tanggal-rental');
        $durasiRental = $request->input('durasi-rental');
        $ambilRental = $request->input('ambil-rental');
        $jamRental = $request->input('jam-rental');

        $query = CarRentalHasCars::query();

        // Filter berdasarkan kategori
        if ($request->input('category') !== null) {
            $query->where('category', $request->input('category'));
        }

        $cars = $query->with(['brand', 'carRental'])->get();
        $categories = CarRentalHasCars::select('category')->distinct()->get();
        
        // Mengambil data carRental untuk digunakan di view
        $carRental = CarRental::all();

        return view('rental-mobil.list-rental-mobil', compact('tanggalRental', 'durasiRental', 'ambilRental', 'jamRental', 'cars', 'categories', 'carRental'));
    }

    public function searchResult()
    {
        return view('rental-mobil-remake.search-result');
    }

}

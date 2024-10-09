<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use PHPUnit\Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CarRentalController extends Controller
{

    public function index(Request $request)
    {
        try {
            $kota = $request->input('kota');
            $tanggalAwal = $request->input('tanggal_awal');
            $durasi = $request->input('durasi');
            $jamPengambilan = $request->input('jam_pengambilan');
            $categoryRent = $request->input('category_rent');

            $carRentals = DB::table('car_rental_has_cars')
                ->join('car_models', 'car_rental_has_cars.car_model_id', '=', 'car_models.id')
                ->join('brands', 'car_rental_has_cars.brand_id', '=', 'brands.id')
                ->join('car_rentals', 'car_rental_has_cars.car_rental_id', '=', 'car_rentals.id')
                ->select(
                    'car_models.name as car_model_name',
                    'brands.name as car_brand_name',
                    'car_rental_has_cars.image_url as img',
                    'car_rental_has_cars.number_seats as number_seat',
                    'car_rental_has_cars.category_rent as category_rent',
                    'car_rental_has_cars.category as category',
                    DB::raw('MIN(car_rental_has_cars.rental_price_per_day) as min_price')
                )
                ->where('car_rentals.city', 'like', '%' . $kota . '%');

            if (!is_null($categoryRent)) {
                if ($categoryRent === true) {
                    $carRentals->where('car_rental_has_cars.category_rent', 'lepas kunci');
                } else {
                    $carRentals->where('car_rental_has_cars.category_rent', 'dengan kunci');
                }
            }

            $carRentalData = $carRentals
                ->groupBy(
                    'car_models.name',
                    'brands.name',
                    'car_rental_has_cars.image_url',
                    'car_rental_has_cars.number_seats',
                    'car_rental_has_cars.category_rent',
                    'car_rental_has_cars.category'
                )
                ->get();

                if ($carRentalData->isNotEmpty()) {
                    return ResponseFormatter::success($carRentalData, 'Data successfully loaded');
                } else {
                    return ResponseFormatter::success([], 'Data successfully loaded');
                }

            } catch (Exception $th) {
                return ResponseFormatter::error($th->getMessage(), 'Car rental process failed', 500);
            }
    }
}

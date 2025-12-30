<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarRental;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
        ->select('users.*')
        ->where('role', 1)
        ->get();

        $car_rentals = DB::table('car_rentals')
        ->join('users', 'car_rentals.user_id', '=', 'users.id')
        ->leftJoin('cities', 'car_rentals.city', '=', 'cities.city_id')
        ->select(
            'car_rentals.id as car_rental_id',
            'car_rentals.phone as car_rental_phone',
            'car_rentals.*',
            'car_rentals.is_active as car_rentals_is_active',
            'users.id as user_id',
            'users.*',
            'cities.city_id as city_id',
            'cities.image as city_image',
            'cities.*'
        )
        ->get();

        $cities = City::all();

        return view('admin.management-mitra.rental-mobil.index', compact('users', 'car_rentals', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'nullable',
            'city' => 'nullable',
            'address' => 'nullable',
            'kebijakan_rental_mobil' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validasi untuk file gambar (10MB)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle image upload jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('car_rentals', 'public');
        }

        DB::table('car_rentals')->insert([
            'business_name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'kebijakan_rental_mobil' => $request->kebijakan_rental_mobil,
            'image' => $imagePath,
            'is_active' => 1,
        ]);

        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car_rental = CarRental::findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    =>  $car_rental
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'nullable',
            'city' => 'nullable',
            'address' => 'nullable',
            'kebijakan_rental_mobil' => 'nullable',
            'is_active' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validasi untuk file gambar (10MB)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $car_rental = CarRental::findOrFail($id);

        // Handle image upload jika ada
        $imagePath = $car_rental->image; // Pertahankan gambar lama jika tidak ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($car_rental->image) {
                $oldImagePath = storage_path('app/public/' . $car_rental->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imagePath = $image->store('car_rentals', 'public');
        }

        $car_rental->update([
            'user_id' => $request->user_id,
            'business_name' => ucwords($request->name),
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'kebijakan_rental_mobil' => $request->kebijakan_rental_mobil,
            'is_active' => $request->is_active,
            'image' => $imagePath,
        ]);


        toast('Mitra has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $car_rental
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car_rental = CarRental::findOrFail($id);
        $car_rental->delete();

        toast('Mitra has been deleted', 'success');
        return redirect()->back();
    }
}

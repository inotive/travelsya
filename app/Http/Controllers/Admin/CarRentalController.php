<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarRental;
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
        ->select(
            'car_rentals.id as car_rental_id', 
            'car_rentals.*', 
            'users.id as user_id', 
            'users.*'
        )
        ->get();


        return view('admin.management-mitra.rental-mobil.index', compact('users', 'car_rentals'));
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
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::table('car_rentals')->insert([
            'business_name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car_rental = CarRental::findOrFail($id);
        $car_rental->delete();

        toast('Clinic has been deleted', 'success');
        return redirect()->back();
    }
}

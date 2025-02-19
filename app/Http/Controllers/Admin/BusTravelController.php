<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusTravels;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusTravelController extends Controller
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

    
        $bus_travels = DB::table('bus_travels')
        ->join('users', 'bus_travels.user_id', '=', 'users.id')
        ->join('cities', 'bus_travels.city', '=', 'cities.city_id')
        ->select(
            'bus_travels.id as bus_travel_id', 
            'bus_travels.phone as bus_travel_phone',
            'bus_travels.*', 
            'users.id as user_id', 
            'users.*',
            'cities.city_id as city_id',
            'cities.image as city_image', 
            'cities.*'
        )
        ->get();

        $cities = City::all();

        return view('admin.management-mitra.bus-travel.index', compact('users', 'bus_travels', 'cities'));
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

        DB::table('bus_travels')->insert([
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
        $bus_travel = BusTravels::findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    =>  $bus_travel
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
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'is_active' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $bus_travel = BusTravels::findOrFail($id);
        $bus_travel->update([
            'user_id' => $request->user_id,
            'business_name' => ucwords($request->name),
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->is_active,
        ]);

    
        toast('Mitra has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $bus_travel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bus_travel = BusTravels::findOrFail($id);
        $bus_travel->delete();

        toast('Mitra has been deleted', 'success');
        return redirect()->back();
    }
}

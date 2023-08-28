<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role',2)->get();
        $hotels = DB::table('hotels')
            ->join('services', 'services.id', '=', 'hotels.service_id')
            ->join('users', 'users.id', '=', 'hotels.user_id')
            ->select('hotels.*', 'services.name as service_name', 'users.name as user_name')
            ->get();
        return view('admin.management-mitra.hotel.index',compact('users', 'hotels'));
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
            $hotel = Hotel::create(
            [
            'user_id' => $request->user_id,
            'is_active' => 1,
            'checkin' => "11:00:00",
            'checkout' => "12:00:00",
            'service_id' => 8,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'star' => $request->star,
            'website' => $request->website
            ]
        );

        return redirect()->route('admin.hotel.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Hotel',
            'data' => $hotel
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
    public function update(Request $request, Hotel $hotel)
    {
        // $hotel = Hotel::findOrFail($id);

        // $hotel->update($request,[
        //     'user_id' => $request->user_id,
        //     'is_active' => $request->is_active,
        //     'checkin' => $request->checkin,
        //     'checkout' => $request->checkout,
        //     'service_id' => 8,
        //     'name' => $request->name,
        //     'address' => $request->address,
        //     'city' => $request->city,
        //     'star' => $request->star,
        // ]);


        $validator = Validator::make($request->all(), [
        'name' =>'required',
        'address' =>'required',
        'star' =>'required',
        'city' =>'required',
        'website' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $hotel->update([
            'user_id' => $request->user_id,
            'is_active' => 1,
            'checkin' => "11:00:00",
            'checkout' => "12:00:00",
            'service_id' => 8,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'star' => $request->star,
            'website' => $request->website,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $hotel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hotel::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index(){
        $cities = DB::table('cities')->get();
        //dd($cities);
        return view('admin.management-city.index', compact('cities'));
    }

    public function updateLanding(Request $request,$id){
        DB::table('cities')->where('city_id', $id)->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.city-management.index');
    }

    public function edit($id) {
    $cities = DB::table('cities')->where('city_id', $id)->get();
    return response()->json([
        $cities
    ]);
    }

public function update(Request $request, $id) {
    $city = DB::table('cities')->where('city_id', $id)->first();

    if (!$city) {
        return response()->json(['message' => 'Kota tidak ditemukan'], 404);
    }

    if ($request->file('image')) {
        // Upload gambar baru
        $image = $request->file('image');
        $image->storeAs('/media/kota/', $image->hashName());

        // Perbarui record di database dengan gambar baru
        DB::table('cities')->where('city_id', $id)->update([
            'image' => $image->hashName()
        ]);

        $city->image = $image;
    }

    return response()->json($city);
}



}

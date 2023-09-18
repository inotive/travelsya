<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {

        $vendors = Hostel::with('user', 'hostelRoom', 'hostelImage');
        $cities = DB::table('cities')->orderBy('city_name','asc')->get();
        // dd($vendors);
         $users = User::with('hostel')
                 ->where('role', 1)->get();
        // dd($users);
        return view('admin.management-mitra.index', compact('vendors','users', 'cities'));
    }

    public function hostelRoomAjax(Request $request)
    {
        $hostelRoom = HostelRoom::where('hostel_id', $request->id)->firstOrFail();

        return response()->json($hostelRoom);
    }

    public function updateMitra(Request $request)
    {
        $hostel = Hostel::find($request->id);
        // dd($request->user_id, $hostel);

        $hostel->update(['user_id' => $request->user_id, 'is_active' => $request->active]);

        toast('User vendor has been updated', 'success');
        return redirect()->back();
    }

    public function storeMitra(Request $request)
    {
        Hostel::create([
            'name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'is_active' => 1,
            'city' => $request->city,
            'kecamatan' => '-',
            'address' => $request->alamat,
            'category' => $request->category,
            'description' => '-',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'star' => $request->star,
            'website' => $request->website,
            'property' => '-']);

        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    public function update(Request $request, Hostel $hostel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $hostel = Hostel::update([
            'name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'is_active' => 1,
            'city' => $request->city,
            'kecamatan' => '-',
            'address' => $request->alamat,
            'category' => $request->category,
            'description' => '-',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'star' => $request->star,
            'website' => $request->website,
            'property' => '-'
        ]);


        toast('Hostel has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $hostel
        ]);
    }

    public function show(Hostel $hostel)
    {
        // $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);
        // return view('admin.hostel-show', compact('hostel'));

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $hostel
        ]);
    }

    public function destroyMitra(Request $request)
    {
        Hostel::find($request->id)->delete();
        toast('Hostel has been deleted', 'danger');
        return redirect()->back();
    }
}

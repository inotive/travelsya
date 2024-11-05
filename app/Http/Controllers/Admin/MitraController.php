<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MitraController extends Controller
{
    use UploadFile;
    public function index()
    {

        $vendors = Hostel::with('user', 'hostelRoom', 'hostelImage');
        // $cities = DB::table('cities')->orderBy('city_name','asc')->get();
        // dd($vendors);

        $users = User::with('hostel', 'hotel')
            ->where('role', 1)->get();
        //         dd($users);
        return view('admin.management-mitra.index', compact('vendors', 'users'));
    }

    public function hostelRoomAjax(Request $request)
    {
        $hostelRoom = HostelRoom::where('hostel_id', $request->id)->firstOrFail();

        return response()->json($hostelRoom);
    }

    public function updateMitra(Request $request, $id)
    {

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image')->store('media/users');
        //     Storage::delete('storage/' . $user->image);
        // }

        $user = User::findorFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'email'    => 'required|email|unique:users,email',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('profile/' . $user->image);
            $image = $this->storeFile($request->file('image'), 'profile');
            $imageProfile = $image;
            $user->update([
                ['email' => $request->email], // Kriteria

                'name' => $request->name,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'phone' => $request->phone,
                'point' => 0,
                'role' => 1,
                'is_active' => $request->is_active,
                'image' => $imageProfile,
                // Nilai
            ]);
        } else {

            //update post without image
            $user->update([
                'email' => $request->email, // Kriteria

                'name' => $request->name,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'phone' => $request->phone,
                'point' => 0,
                'role' => 1,
                'is_active' => $request->is_active,
                // Nilai
            ]);
        }

        toast('User vendor has been updated', 'success');
        return redirect()->back();
    }

    public function storeMitra(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if ($request->hasFile('image')) {
            $image = $this->storeFile($request->file('image'), 'profile');
            $imageProfile = $image;
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'image' => $imageProfile,
                'phone' => $request->nomor_telfon,
                'point' => 0,
                'role' => 1,
                'is_active' => 1,
            ]);
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->nomor_telfon,
                'point' => 0,
                'role' => 1,
                'is_active' => 1,
            ]);
        }


        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    public function update(Request $request, Hostel $hostel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $user = User::update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->nomor_telfon,
        ]);

        /*
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
        ]);*/


        toast('Hostel has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $hostel
        ]);
    }

    public function show($id)
    {
        // $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);
        // return view('admin.hostel-show', compact('hostel'));
        $user = User::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data User',
            'data'    => $user
        ]);
    }

    public function destroyMitra($id)
    {
        $mitra = User::find($id)->delete();
        Storage::delete('storage/' . $mitra->image);

        toast('Hostel has been deleted', 'danger');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\User;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $vendors = Hostel::with('user', 'hostelRoom', 'hostelImage')->paginate(10);
        // dd($vendors);
        $users = User::where('role', 1)->get();

        return view('admin.mitra', compact('vendors', 'users'));
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
        Hostel::create(['name' => ucwords($request->name), 'user_id' => $request->user_id, 'is_active' => $request->active, 'city' => $request->city, 'category' => $request->category]);

        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    public function destroyMitra(Request $request)
    {
        Hostel::find($request->id)->delete();
        toast('Hostel has been deleted', 'danger');
        return redirect()->back();
    }
}

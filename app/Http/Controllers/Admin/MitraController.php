<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HostelRoom;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        return view('admin.mitra');
    }

    public function hostelRoomAjax(Request $request)
    {
        $hostelRoom = HostelRoom::where('hostel_id', $request->id)->firstOrFail();

        return response()->json($hostelRoom);
    }
}

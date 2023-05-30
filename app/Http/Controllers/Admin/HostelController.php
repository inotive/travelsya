<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::with('hostelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.hostel', compact('hostels'));
    }

    public function show($id)
    {
        $hostel = Hostel::find($id);

        return view('admin.hostel-show', compact('hostel'));
    }
}

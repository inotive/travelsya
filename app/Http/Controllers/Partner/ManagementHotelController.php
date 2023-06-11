<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use Illuminate\Http\Request;

class ManagementHotelController extends Controller
{

    // Daftar Hotel
    public function index()
    {
        $hostels = Hostel::with('hostelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.partner.management-hotel.index', compact('hostels'));
    }

    public function detailHotel($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('admin.partner.management-hotel.detail-hotel', compact('hostel'));
    }
    public function settingHotel($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('admin.partner.management-hotel.setting-hotel', compact('hostel'));
    }
    public function settingRoom()
    {
        return view('admin.partner.management-hotel.setting-rooms');
    }
    public function settingPhoto($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);

        return view('admin.partner.management-hotel.setting-photo', compact('hostel'));
    }
}

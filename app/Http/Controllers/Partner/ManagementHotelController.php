<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementHotelController extends Controller
{

    // Daftar Hotel
    public function index()
    {
        return view('admin.partner.management-hotel.index');
    }

    public function detailHotel()
    {
        return view('admin.partner.management-hotel.detail-hotel');
    }
    public function settingHotel()
    {
        return view('admin.partner.management-hotel.setting-hotel');
    }
    public function settingRoom()
    {
        return view('admin.partner.management-hotel.setting-rooms');
    }
    public function settingPhoto()
    {
        return view('admin.partner.management-hotel.setting-photo');
    }
}

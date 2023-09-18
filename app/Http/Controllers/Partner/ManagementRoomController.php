<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\HostelRoom;
use App\Models\HotelRoom;
use Illuminate\Http\Request;

class ManagementRoomController extends Controller
{
    public function index()
    {
        $hotelRooms = HotelRoom::all();
        $hostelRooms = HostelRoom::all();

        // $rooms = $hotelRooms->merge($hostelRooms);

        return view('ekstranet.management-room.index', compact('hotelRooms', 'hostelRooms'));
    }
}

<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

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
    public function settingRoom($id)
    {
        $hostel = Hostel::with('hostelRoom')->find($id);

        return view('admin.partner.management-hotel.setting-rooms', compact('hostel'));
    }

    public function settingRoomPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'name' => 'required',
            'sellingprice' => 'required',
            'totalroom' => 'required',
            'roomsize' => 'required',
            'guest' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $facilities = [];
        if ($request->breakfastIncluded == 'on')
            array_push($facilities, 'breakfast');

        if ($request->wifiIncluded == 'on')
            array_push($facilities, 'wifi');

        $facstring = '[';
        foreach ($facilities as $key => $facility) {
            $facstring .= $facility;
            if (array_key_last($facilities) != $key)
                $facstring .= ',';
        }

        $request['facilities'] = $facstring . ']';

        $hostel = Hostel::find($request->hostel_id);
        $request['image_1'] = $request->file('image')->store(
            'hostel/' . Str::slug($hostel->name, '-') . '/' . Str::slug($request->name, '-'),
            'public',
        );

        HostelRoom::create($request->except('image', 'wifiIncluded', 'breakfastIncluded'));
        toast('Hostelroom berhasil dibuat', 'success');
        return redirect()->back();
    }
    public function settingPhoto($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);

        return view('admin.partner.management-hotel.setting-photo', compact('hostel'));
    }
}

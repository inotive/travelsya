<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Hotel;
use App\Models\HotelImage;
use App\Models\HotelRoom;
use App\Models\HotelRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use File;

class ManagementHotelController extends Controller
{

    // Daftar Hotel
    public function index()
    {
        $hotels = Hotel::with('hotelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('ekstranet.management-hotel.index', compact('hotels'));
    }

    public function detailHotel($id)
    {
        $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelbookDate', 'hotelroomFacility', 'hotelRule')->find($id);
        $avg_rate = DB::table('hotel_ratings')->where('hotel_id', $id)->avg('rate');
        $total_review = DB::table('hotel_ratings')->where('hotel_id', $id)->count();

        return view('ekstranet.management-hotel.detail-hotel', compact('hotel', 'avg_rate', 'total_review'));
    }
    public function settingHotel($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('ekstranet.management-hotel.setting-hotel', compact('hostel'));
    }
    public function settingRoom($id)
    {
        $hostel = Hostel::with('hostelRoom')->find($id);

        return view('ekstranet.management-hotel.setting-rooms', compact('hostel'));
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
        return view('ekstranet.management-hotel.setting-photo', compact('hostel'));
    }

    public function destroyRoom($id)
    {
        $hotel_room = HotelRoom::findOrFail($id);
        $hotel_room->delete();

        toast('Hotel Room has been deleted', 'success');
        return redirect()->back();
    }

    public function destroyimage($id, HotelImage $hotelImage)
    {
        $hotelImage = HotelImage::findOrFail($id);
        Storage::delete('media/hotel/'.$hotelImage->image);
    
        $hotelImage->delete();


        toast('Hotel Image has been deleted', 'success');
        return redirect()->back();
    }

    public function storeRule(Request $request)
    {
        $this->validate($request, [
            // 'hotel_id'  => 'required',
            'name'  => 'required'
        ]);

        HotelRule::create([
            'name'  => $request->name,
            'hotel_id' => $request->hotel_id,
        ]);
        toast('Hotel Rule has been created', 'success');
        return redirect()->back();
    }

    public function showRule(Request $request)
    {
        $hotelRule = HotelRule::where('id', $request->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Hotel Rules',
            'data'    => $hotelRule
        ]);
    }

    public function updaterule(Request $request, HotelRule $HotelRule,$id)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id'  => 'required',
            'name'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
            

        
        $HotelRule = HotelRule::find($id);
        $HotelRule->update([
            'hotel_id'  => $request->hotel_id,
            'name'  => $request->name
        ]);

        toast('Hotel Rule has been Updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $HotelRule 
        ]);
        // return redirect()->back();
    }
    public function destroyRule($id)
    {
        $hotel_rule = HotelRule::findorfail($id);
        $hotel_rule->delete();
        toast('Hotel Rule has been Deleted', 'success');
        return redirect()->back();
    }
}
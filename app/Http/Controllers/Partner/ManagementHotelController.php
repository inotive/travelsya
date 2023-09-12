<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelRoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagementHotelController extends Controller
{

    // Daftar Hotel
    public function index()
    {
        $hotels = Hotel::with('hotelRoom')->paginate(6);

        return view('ekstranet.management-hotel.index', compact('hotels'));
    }

    public function detailHotel($id)
    {
        $hotel = Hotel::with('hotelRoom', 'hotelImage')->find($id);

        return view('ekstranet.management-hotel.detail-hotel', compact('hotel'));
    }
    public function settingHotel($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('ekstranet.management-hotel.setting-hotel', compact('hostel'));
    }
    // public function settingRoom($id)
    // {
    //     $hostel = Hostel::with('hostelRoom')->find($id);

    //     return view('ekstranet.management-hotel.setting-rooms', compact('hostel'));
    // }

    // public function settingRoomPost(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'price' => 'required',
    //         'name' => 'required',
    //         'sellingprice' => 'required',
    //         'totalroom' => 'required',
    //         'roomsize' => 'required',
    //         'guest' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $facilities = [];
    //     if ($request->breakfastIncluded == 'on')
    //         array_push($facilities, 'breakfast');

    //     if ($request->wifiIncluded == 'on')
    //         array_push($facilities, 'wifi');

    //     $facstring = '[';
    //     foreach ($facilities as $key => $facility) {
    //         $facstring .= $facility;
    //         if (array_key_last($facilities) != $key)
    //             $facstring .= ',';
    //     }

    //     $request['facilities'] = $facstring . ']';

    //     $hostel = Hostel::find($request->hostel_id);
    //     $request['image_1'] = $request->file('image')->store(
    //         'hostel/' . Str::slug($hostel->name, '-') . '/' . Str::slug($request->name, '-'),
    //         'public',
    //     );

    //     HostelRoom::create($request->except('image', 'wifiIncluded', 'breakfastIncluded'));
    //     toast('Hostelroom berhasil dibuat', 'success');
    //     return redirect()->back();
    // }

        public function settingRoom($id)
    {
        $hotel = Hotel::with('hotelRoom')->find($id);
        $hotelRoom = $hotel->hotelRoom;
        $facilities = Facility::all();
        $roomFacilitiesIds = $facilities->pluck('facility_id')->toArray();
        $responsJson = [
        'data' => [
            'hotel_room' => $hotelRoom,
            'facilities' => $facilities,
            'roomFacilitiesIds' => $roomFacilitiesIds,
        ],
    ];
        $data = $responsJson['data'];
        return view('ekstranet.management-hotel.setting-rooms', compact('hotel', 'facilities', 'data'));
    }

    // public function settingRoom($id)
    // {
    //     $hostel = Hostel::with('hostelRoom')->find($id);

    //     return view('ekstranet.management-hotel.setting-rooms', compact('hostel'));
    // }

    //Aksi Untuk Membuat Data Room
    public function settingRoomCreate($id)
    {
        $hotel = Hotel::with('hotelRoom')->find($id);
        $facility = Facility::all();

        return view('ekstranet.management-hotel.setting-room-create', compact('hotel', 'facility'));
    }

    //Aksi Untuk Menyetor Data Room Ke Database
    public function settingRoomPost(Request $request)
{
        //$data = $request->all();
        //dd($data);

    //Ini validasi
    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'sellingprice' => 'required',
        'totalroom' => 'required',
        'roomsize' => 'required',
        'maxextrabed' => 'required',
        'bed_type' => 'required',
        'guest' => 'required',
        'image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    //Ini Input image
    $image = $request->file('image_1');
    $image->storeAs('public/media/hotel', $image->hashName());

    //Insetrt Data Baru
    $hotelRoom = HotelRoom::create([
        'hotel_id' => $request->hotel_id,
        'name' => $request->name,
        'price' => $request->price,
        'roomsize' => $request->roomsize,
        'guest' => $request->guest,
        'maxextrabed' => $request->maxextrabed,
        'bed_type' => $request->bed_type,
        'totalroom' => $request->totalroom,
        'image_1' => $image->hashName(),
        'is_active' => 1,
        'sellingprice' => $request->sellingprice,
    ]);

    $facilityIds = $request->input('facility_id', []);
    $roomId = $hotelRoom->id;

    foreach ($facilityIds as $facilityId) {
    DB::table('hotel_room_facilities')->insert([
        'hotel_id' => $request->hotel_id,
        'service_id' => 8,
        'hotel_room_id' => $roomId,
        'facility_id' => $facilityId,
    ]);
}

        //Ini untuk pemberitahuan
        toast('HotelRoom berhasil dibuat', 'success');
        return redirect()->back();
}
        public function settingPhoto($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);
        return view('ekstranet.management-hotel.setting-photo', compact('hostel'));
    }

//     public function settingRoomShow($hotel_id, $id)
// {
//     $data = HotelRoom::where('id', $id)
//                     ->where('hotel_id', $hotel_id)
//                     ->first();

//     if (!$data) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Data Room Tidak Ditemukan',
//             'data' => null,
//         ]);
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Detail Data Room',
//         'data' => $data,
//     ]);
// }

//ini untuk mengirim data room pake ajax
// public function settingRoomShow($hotel_id, $id)
// {
//     $hotelRoom = HotelRoom::where('id', $id)
//                     ->where('hotel_id', $hotel_id)
//                     ->first();

//     if (!$hotelRoom) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Data Room Tidak Ditemukan',
//             'data' => null,
//         ]);
//     }

//     // Ambil data fasilitas (facility) yg
//     $facilities = HotelRoomFacility::where('hotel_room_id', $hotelRoom->id)->get();


//     return response()->json([
//         'success' => true,
//         'message' => 'Detail Data Room',
//         'data' => [
//             'hotel_room' => $hotelRoom,
//             'facilities' => $facilities,
//         ],
//     ]);
//     $roomFacilitiesIds = $responseJson['data']['facilities']->pluck('id')->toArray();
// }

public function settingRoomShow($hotel_id, $id)
{
    $hotelRoom = HotelRoom::where('id', $id)
                    ->where('hotel_id', $hotel_id)
                    ->first();

    if (!$hotelRoom) {
        return response()->json([
            'success' => false,
            'message' => 'Data Room Tidak Ditemukan',
            'data' => null,
        ]);
    }

    // Ambil data fasilitas (facility)
    $facilities = HotelRoomFacility::where('hotel_room_id', $hotelRoom->id)->get();

    return response()->json([
        'success' => true,
        'message' => 'Detail Data Room',
        'data' => [
            'hotel_room' => $hotelRoom,
            'facilities' => $facilities,
        ],
    ]);
}


//ini aksi untuk update
    public function settingRoomUpdate(Request $request, $hotel_id, $id)
   {
        //dd($request->all());
        $hotelRoom = HotelRoom::where('id', $id)
                    ->where('hotel_id', $hotel_id)
                    ->first();

        $facilities = Facility::all();

        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required',
        'roomsize' => 'required',
        'guest' => 'required',
        'maxextrabed' => 'required',
        'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        'bed_type' => 'required',
        'totalroom' => 'required',
        'image_1' => 'max:2048',
        'sellingprice' => 'required',
        'facility_id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $facilityIds = $request->input('facility_id');
        //$facilityIds = explode(',', $request->input('facility_id'));


        if($request->hasFile('image_1')){
            $image_1 = $request->file('image_1');
            $image_1->storeAs('public/media/hotel', $image_1->hashName());

            Storage::delete('public/media/hotel', $hotelRoom->image_1);

        $hotelRoom->update([
        'hotel_id' => $request->hotel_id,
        'name' => $request->name,
        'price' => $request->price,
        'roomsize' => $request->roomsize,
        'guest' => $request->guest,
        'maxextrabed' => $request->maxextrabed,
        'bed_type' => $request->bed_type,
        'totalroom' => $request->totalroom,
        'image_1' => $image_1->hashName(),
        'sellingprice' => $request->sellingprice,
        ]);

        // Hapus fasilitas lama
        DB::table('hotel_room_facilities')
            ->where('hotel_room_id', $hotelRoom->id)
            ->delete();

        // Tambahkan fasilitas yang baru
        foreach ($facilityIds as $facilityId) {
            DB::table('hotel_room_facilities')->insert([
                'hotel_id' => $request->hotel_id,
                'service_id' => 8,
                'hotel_room_id' => $hotelRoom->id,
                'facility_id' => $facilityId,
            ]);
        }

        }else{
        $hotelRoom->update([
        'hotel_id' => $request->hotel_id,
        'name' => $request->name,
        'price' => $request->price,
        'roomsize' => $request->roomsize,
        'guest' => $request->guest,
        'maxextrabed' => $request->maxextrabed,
        'bed_type' => $request->bed_type,
        'totalroom' => $request->totalroom,
        'sellingprice' => $request->sellingprice,
        ]);

        // Hapus fasilitas lama
        DB::table('hotel_room_facilities')
            ->where('hotel_room_id', $hotelRoom->id)
            ->delete();

        // Tambahkan fasilitas yang baru
        foreach ($facilityIds as $facilityId) {
            DB::table('hotel_room_facilities')->insert([
                'hotel_id' => $request->hotel_id,
                'service_id' => 8,
                'hotel_room_id' => $hotelRoom->id,
                'facility_id' => $facilityId,
            ]);
        }

        }

        $updatedData = $hotelRoom->fresh();
        // Ambil fasilitas yang diperbarui
        $updatedFacilities = DB::table('hotel_room_facilities')
            ->where('hotel_room_id', $updatedData->id)
            ->get();

        toast('Hotel Room Has Been Updated', 'success');

        return response()->json([
            'success' => true,
            'message' => 'Data HotelRoom Berhasil Diudapte!',
            'data' => [
            'updatedData' => $updatedData,
            'facilities' => $facilities,
            'updatedFacilities' => $updatedFacilities,
        ],
        ]);
    }


    public function settingRoomDelete(string $id)
    {
        HotelRoom::where('id', $id)->delete();
        HotelRoomFacility::where('hotel_room_id', $id)->delete();
        toast('Hotel Has Been Removed', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);


    }
}

<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\DetailTransactionHotel;
use App\Models\Facility;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Hotel;
use App\Models\HotelImage;
use App\Models\HotelRoomImage;
use App\Models\HotelRoom;
use App\Models\HotelRoomFacility;
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
        $hotels = Hotel::with('hotelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate();
        return view('ekstranet.management-hotel.index', compact('hotels'));
    }

    public function detailHotel($id)
    {
        //$hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating', 'hotel', 'hotelroomFacility', 'hotelRule', 'hotelBookDate')->find($id);
        $hotel = Hotel::with('hotelRoom', 'hotelImage', 'hotelRating', 'hotelroomFacility', 'hotelRule', 'hotel_reservation')->find($id);
        $avg_rate = DB::table('hotel_ratings')->where('hotel_id', $id)->avg('rate');
        $total_review = DB::table('hotel_ratings')->where('hotel_id', $id)->count();
        return view('ekstranet.management-hotel.detail-hotel', compact('hotel', 'avg_rate', 'total_review'));
    }

    public function settingHotel($id)
    {
        $hotel = Hotel::with('hotelRoom', 'hotelImage')->find($id);

        return view('ekstranet.management-hotel.setting-hotel', compact('hotel'));
    }

    public function settingHotelupdate(Request $request, Hotel $hotel)
    {
        $user_id = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'star' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $hotel->update([
            'user_id' => $user_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'star' => $request->star,
            'phone' => $request->phone,
            'website' => $request->website,
            'lon' => $request->long_ltd,
            'lat' => $request->ltd,
            'description' => $request->description,
        ]);

        toast('Hotel Has Been Updated', 'success');

        return redirect()->back();
    }
    public function settingRoom($id)
    {
        $hotel = Hotel::with('hotelRoom')->find($id);
        $hotelRoom = $hotel->hotelRoom;
        $hotelroomimage = $hotel->hotelroomImage;
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


    public function settingRoomCreate($id)
    {
        $hotel = Hotel::with('hotelRoom')->find($id);
        $facility = Facility::all();

        return view('ekstranet.management-hotel.setting-room-create', compact('hotel', 'facility'));
    }

    public function settingRoomEdit($id, $room_id)
    {

        // dd($room_id);
        // $hotel = Hotel::whereHas('hotelRoom', function($query) use ($room_id) {
        //     $query->where('id', $room_id);
        // })->first();
        $hotel = Hotel::with('hotelRoom')->find($id); // Mengambil hotel dengan id tertentu
        $room = hotelRoom::with('hotelroomFacility')->where('id', $room_id)->first();
        $facility = Facility::all();
        // $room = hotelRoom::where('hotel_id', $id)->first();
        return view('ekstranet.management-hotel.setting-room-update', compact('hotel', 'facility', 'room'));
    }

    public function settingRoomPost(Request $request)
    {
        $data = $request->all();
        //Ini validasi
        //        $request->validate([
        //            'name' => 'required',
        //            'price' => 'required',
        //            'sellingprice' => 'required',
        //            'totalroom' => 'required',
        //            'roomsize' => 'required',
        //            // 'maxextrabed' => 'required',
        //            'bed_type' => 'required',
        //            'guest' => 'required',
        //            // 'image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //        ]);



        //Insetrt Data Baru
        $hotelRoom = HotelRoom::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'roomsize' => $request->roomsize,
            'guest' => $request->guest,
            'maxextrabed' => $request->maxextrabed,
            'bed_type' => $request->bed_type,
            'totalroom' => $request->totalroom,
            'is_active' => 1,
            'sellingprice' => $request->sellingprice == null ? 0 : str_replace('.', '', $request->sellingprice),
            'extrabed_price' => $request->extrabedprice == null ? 0 : str_replace('.', '', $request->extrabedprice),
            'extrabed_sellingprice' => $request->extrabedsellingprice == null ? 0 : str_replace('.', '', $request->extrabedsellingprice),
        ]);

        $hotelRoomImageFiles = $request->file('hotel_room_image', []);
        $hotel_id = $hotelRoom->hotel->id;

        foreach ($hotelRoomImageFiles as $imageFile) {
            $path = $imageFile->store('media/hotel/');
            $filename = basename($path);

            DB::table('hotel_room_images')->insert([
                'hotel_id' => $hotel_id,
                'hotel_room_id' => $hotelRoom->id, // Menggunakan ID dari kamar hotel yang baru saja dibuat
                'image' => 'media/hotel/' . $filename,
            ]);
        }

        $facilityIds = $request->input('facility_id', []);
        $roomId = $hotelRoom->id;

        foreach ($facilityIds as $facilityId) {
            DB::table('hotel_room_facilities')->insert([
                'hotel_id' => $request->hotel_id,
                'hotel_room_id' => $roomId,
                'facility_id' => $facilityId,
            ]);
        }

        //Ini untuk pemberitahuan
        toast('HotelRoom berhasil dibuat', 'success');
        return redirect()->route('partner.management.hotel.setting.room', ['id' => $request->hotel_id]);
    }
    public function settingPhoto($id)
    {
        $hotel = Hotel::with('hotelImage')->find($id);
        return view('ekstranet.management-hotel.setting-photo', compact('hotel'));
    }

    public function storePhotoHotel($id, Request $request)
    {

        $image = $request->file('image')->store('media/hotel');
        // dd($image);
        HotelImage::create([
            'hotel_id' => $id,
            'image' => $image,
            'main' => 0
        ]);



        toast('Upload foto berhasil', 'success');
        return redirect()->back();
        //        return view('ekstranet.management-hotel.setting-photo', compact('hotel'));
    }

    public function mainphotoHotel($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $hotelImage = HotelImage::find($id);

        if ($hotelImage) {
            HotelImage::where('hotel_id', $request->hotel_id)
                ->update([
                    'main' => 0
                ]);
            $hotelImage->update([
                'main' => 1,
            ]);


            toast('Foto Utama Hotel berhasil diperbarui', 'success');

            return redirect()->back();
        } else {
            return response()->json(['error' => 'Gambar Hotel tidak ditemukan'], 404);
        }
    }

    public function destroyphotoHotel($id)
    {

        $hotelImage = HotelImage::findOrFail($id);
        Storage::delete($hotelImage->image);

        $hotelImage->delete();

        toast('Hotel Image has been deleted', 'success');
        return redirect()->back();
    }


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
        // dd($id);
        $hotelRoom = HotelRoom::where('id', $id)
            ->where('hotel_id', $hotel_id)
            ->first();

        $facilities = Facility::all();


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'roomsize' => 'required',
            'guest' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            // 'bed_type' => 'required',
            'totalroom' => 'required',
            'sellingprice' => 'required',
            'facility_id' => 'nullable',
        ]);


        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);

            $errors = $validator->errors();
            $errorMessage = $errors->first('facility_id');
            if ($errorMessage != null) {
                toast($errorMessage, 'error');
            }


            return redirect()->back()->with([
                'success' => false,
                'message' => 'Gagal Update Room!',

            ]);
        }

        $facilityIds = $request->input('facility_id');

        // if ($facilityIds == null) {
        //     toast('Facilitas Wajib Di Pilih', 'error');

        //     return redirect()->back()->with([
        //         'success' => false,
        //         'message' => 'Gagal Update Room!',

        //     ]);
        // }



        if ($request->hasFile('hotel_room_images')) {
            $imageFiles = $request->file('hotel_room_images');

            foreach ($hotelRoom->hotelroomimage as $index => $image) {
                if (isset($imageFiles[$index])) {
                    Storage::delete('public/' . $image->image);

                    $path = $imageFiles[$index]->store('media/hotel/');
                    $filename = basename($path);

                    $image->update(['image' => 'media/hotel/' . $filename]);
                }
            }


            $hotelRoom->update([
                'hotel_id' => $request->hotel_id,
                'name' => $request->name,
                'price' => str_replace('.', '', $request->price),
                'roomsize' => $request->roomsize,
                'guest' => $request->guest,
                'maxextrabed' => $request->maxextrabed,
                'bed_type' => $request->bed_type,
                'totalroom' => $request->totalroom,
                'sellingprice' => $request->sellingprice == null ? 0 : str_replace('.', '', $request->sellingprice),
                'extrabed_price' => $request->extrabedprice == null ? 0 : str_replace('.', '', $request->extrabedprice),
                'extrabed_sellingprice' => $request->extrabedsellingprice == null ? 0 : str_replace('.', '', $request->extrabedsellingprice),
            ]);


            // Hapus fasilitas lama
            DB::table('hotel_room_facilities')
                ->where('hotel_room_id', $id)
                ->delete();
            if ($facilityIds !== null) {
                // Tambahkan fasilitas yang baru
                foreach ($facilityIds as $facilityId) {
                    DB::table('hotel_room_facilities')->insert([
                        'hotel_id' => $request->hotel_id,
                        'hotel_room_id' => $hotelRoom->id,
                        'facility_id' => $facilityId,
                    ]);
                }

            }

        } else {
            $hotelRoom->update([
                'hotel_id' => $request->hotel_id,
                'name' => $request->name,
                'price' => str_replace('.', '', $request->price),
                'roomsize' => $request->roomsize,
                'guest' => $request->guest,
                'maxextrabed' => $request->maxextrabed,
                'bed_type' => $request->bed_type,
                'totalroom' => $request->totalroom,
                'sellingprice' => $request->sellingprice == null ? 0 : str_replace('.', '', $request->sellingprice),
                'extrabed_price' => $request->extrabedprice == null ? 0 : str_replace('.', '', $request->extrabedprice),
                'extrabed_sellingprice' => $request->extrabedsellingprice == null ? 0 : str_replace('.', '', $request->extrabedsellingprice),
            ]);


            // Hapus fasilitas lama
            DB::table('hotel_room_facilities')
                ->where('hotel_room_id', $id)
                ->delete();

            if ($facilityIds !== null) {
                // Tambahkan fasilitas yang baru
                foreach ($facilityIds as $facilityId) {
                    DB::table('hotel_room_facilities')->insert([
                        'hotel_id' => $request->hotel_id,
                        'hotel_room_id' => $hotelRoom->id,
                        'facility_id' => $facilityId,
                    ]);
                }
            }
        }

        $updatedData = $hotelRoom->fresh();
        // Ambil fasilitas yang diperbarui
        $updatedFacilities = DB::table('hotel_room_facilities')
            ->where('hotel_room_id', $updatedData->id)
            ->get();

        toast('Hotel Room Has Been Updated', 'success');

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Data HotelRoom Berhasil Diupdate!',
            'data' => [
                'updatedData' => $updatedData,
                'facilities' => $facilities,
                'updatedFacilities' => $updatedFacilities,
            ]
        ]);
    }

    public function settingRoomDelete(string $id)
    {
        if (DetailTransactionHotel::where('hotel_room_id', $id)->exists()) {
            toast('Hotel Ini Sudah Memiliki Beberapa Transaksi', 'error');
            return redirect()->back();
        }
        HotelRoom::where('id', $id)->delete();
        HotelRoomFacility::where('hotel_room_id', $id)->delete();
        toast('Hotel Room Has Been Removed', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
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
        Storage::delete('media/hotel/' . $hotelImage->image);

        $hotelImage->delete();


        toast('Hotel Image has been deleted', 'success');
        return redirect()->back();
    }

    public function storeRule(Request $request)
    {
        $this->validate($request, [
            // 'hotel_id'  => 'required',
            'description' => 'required'
        ]);

        HotelRule::create([
            'description' => $request->description,
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
            'data' => $hotelRule
        ]);
    }

    public function updaterule(Request $request, HotelRule $HotelRule, $id)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        $HotelRule = HotelRule::find($id);
        $HotelRule->update([
            'hotel_id' => $request->hotel_id,
            'description' => $request->description
        ]);

        toast('Hotel Rule has been Updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data' => $HotelRule
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

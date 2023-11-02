<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\HostelRoom;
use App\Models\HostelRoomImages;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use App\Models\HotelRoomImage;
use App\Models\HostelRoomFacility;
use App\Models\HotelRoomFacility;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\Parameter;

class ManagementRoomController extends Controller
{
    public function index(Request $request)
    {

        // $category = Parameter$category
        if ($request->category == 'hotel') {
            $rooms = HotelRoom::with('hotel')
                ->whereHas('Hotel', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate();
        } elseif ($request->category == 'hostel') {
            $rooms = HostelRoom::with('hostel')
                ->whereHas('Hostel', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate();
        }

        return view('ekstranet.management-room.index', compact('rooms'));
    }
    // public function index($category)
    // {
    //     // $hotelRooms = HotelRoom::all();
    //     // $hostelRooms = HostelRoom::all();

    //     if ($category == 'hotel') {
    //         $rooms = HotelRoom::with('Hotel')
    //             ->whereHas('Hotel', function ($query) {
    //                 $query->where('user_id', auth()->user()->id);
    //             })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(); // Ganti ini dengan cara Anda mengambil data kamar hotel
    //     } elseif ($category == 'hostel') {
    //         $rooms = HostelRoom::with('Hostel')
    //             ->whereHas('Hostel', function ($query) {
    //                 $query->where('user_id', auth()->user()->id);
    //             })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate();; // Ganti ini dengan cara Anda mengambil data kamar hostel
    //     }
    //     // $hotelRooms = HotelRoom::with('Hotel')
    //     //     ->whereHas('Hotel', function ($query) {
    //     //         $query->where('user_id', auth()->user()->id);
    //     //     })
    //     //     ->orderBy('created_at', 'desc')
    //     //     ->paginate();

    //     // $hostelRooms = HostelRoom::with('Hostel')
    //     //     ->whereHas('Hostel', function ($query) {
    //     //         $query->where('user_id', auth()->user()->id);
    //     //     })
    //     //     ->orderBy('created_at', 'desc')
    //     //     ->paginate();

    //     // $rooms = $hotelRooms->merge($hostelRooms);

    //     return view('ekstranet.management-room.index', compact('rooms'));
    // }

    public function detailroomhotel($id)
    {
        $hotelrooms = HotelRoom::with('hotelBookDate')->find($id);
        // $hostelrooms = HostelRoom::with('hostelbookdate')->find($id);

        return view('ekstranet.management-room.detail-room-hotel', compact('hotelrooms'));
    }

    public function detailroomhostel($id)
    {
        $hostelrooms = HostelRoom::with('bookdate')->find($id);

        return view('ekstranet.management-room.detail-room-hostel', compact('hostelrooms'));
    }

    public function showhotelroomImage(Request $request)
    {
        $hotelRoomImage = HotelRoomImage::where('id', $request->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Hotel Room Image',
            'data'    => $hotelRoomImage
        ]);
    }

    // public function updatehotelroomImage(Request $request, HotelRoomImage $hotelRoomImage, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'hotel_id' => 'required',
    //         'hotel_room_id' => 'required',
    //         'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }


    //     $image = $request->file('image')->store('public/media/hotel/');

    //     Storage::delete('public/media/hotel/' . $hotelRoomImage->image);

    //     $hotelRoomImage = HotelRoomImage::find($id);
    //     $hotelRoomImage->update([
    //         'hotel_id'  => $request->hotel_id,
    //         'hotel_room_id' => $request->hotel_room_id,
    //         'image'     => $image,
    //     ]);



    //     toast('Hotel Room Image has been updated', 'success');
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Berhasil Diupdate!',
    //         'data'    => $hotelRoomImage
    //     ]);
    // }

    public function storehotelroomImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'hotel_room_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image')->store('media/hotel');

        $hotelRoomImage = HotelRoomImage::create([
            'hotel_id' => $request->hotel_id,
            'hotel_room_id' => $request->hotel_room_id,
            'image' => $image,
        ]);

        toast('Hotel Room Image has been created', 'success');

        return redirect()->back();
    }

    public function updatehotelroomImage(Request $request, HotelRoomImage $hotelRoomImage, $id)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'hotel_room_id' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image')->store('media/hotel');

        $hotelRoomImage = HotelRoomImage::find($id);
        if ($hotelRoomImage) {
            Storage::delete($hotelRoomImage->image);

            $hotelRoomImage->update([
                'hotel_id'  => $request->hotel_id,
                'hotel_room_id' => $request->hotel_room_id,
                'image'     => $image,
            ]);

            toast('Hotel Room Image has been updated', 'success');

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate!',
                'data'    => $hotelRoomImage
            ]);
        } else {
            // Handle ketika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }
    }

    public function destroyhotelroomimage(HotelRoomImage $hotelRoomImage, $id)
    {
        $hotelRoomImage = HotelRoomImage::find($id);

        Storage::delete($hotelRoomImage->image);

        $hotelRoomImage->delete();

        toast('Hotel Room Image has been deleted', 'success');
        return redirect()->back();
    }


    // HOSTEL HOSTEL

    public function showhostelroomImage(Request $request)
    {
        $hostelRoomImage = HostelRoomImages::where('id', $request->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Hotel Room Image',
            'data'    => $hostelRoomImage
        ]);
    }

    public function storehostelroomImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hostel_id' => 'required',
            'hostel_room_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image')->store('media/hostel');

        $hostelRoomImage = HostelRoomImages::create([
            'hostel_id' => $request->hostel_id,
            'hostel_room_id' => $request->hostel_room_id,
            'image' => $image,
        ]);

        toast('Hostel Room Image has been created', 'success');

        return redirect()->back();
    }

    public function updatehostelroomImage(Request $request, HostelRoomImages $hostelRoomImage, $id)
    {
        $validator = Validator::make($request->all(), [
            'hostel_id' => 'required',
            'hostel_room_id' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image')->store('media/hostel');

        $hostelRoomImage = HostelRoomImages::find($id);
        if ($hostelRoomImage) {
            Storage::delete($hostelRoomImage->image);

            $hostelRoomImage->update([
                'hostel_id'  => $request->hostel_id,
                'hostel_room_id' => $request->hostel_room_id,
                'image'     => $image,
            ]);

            toast('Hostel Room Image has been updated', 'success');

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate!',
                'data'    => $hostelRoomImage
            ]);
        } else {
            // Handle ketika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }
    }

    public function destroyhostelroomimage(hostelRoomImages $hostelRoomImage, $id)
    {
        $hostelRoomImage = hostelRoomImages::find($id);

        Storage::delete($hostelRoomImage->image);

        $hostelRoomImage->delete();

        toast('Hostel Room Image has been deleted', 'success');
        return redirect()->back();
    }

    public function deleteroom($type, $id)
    {
        if ($type == 'hotel') {
            $room = HotelRoom::where('id', $id)->delete();
            HotelRoomFacility::where('hostel_room_id', $id)->delete();
        } elseif ($type == 'hostel') {
            $room = HostelRoom::where('id', $id)->delete();
            HostelRoomFacility::where('hostel_room_id', $id)->delete();
        }

        if (!$room) {
            return redirect()->back()->with('error', 'Kamar tidak ditemukan');
        }

        // Lakukan proses penghapusan di sini

        return redirect()->back()->with('success', 'Kamar berhasil dihapus');
    }

    public function HotelRoomDelete($id)
    {
        HotelRoom::where('id', $id)->delete();
        HotelRoomFacility::where('hotel_room_id', $id)->delete();
        toast('Hotel Room Has Been Removed', 'success');
        return redirect()->back();
    }

    public function HostelRoomDelete($id)
    {
        HostelRoom::where('id', $id)->delete();
        HostelRoomFacility::where('hostel_room_id', $id)->delete();
        toast('Hostel Room Has Been Removed', 'success');
        return redirect()->back();
    }
}

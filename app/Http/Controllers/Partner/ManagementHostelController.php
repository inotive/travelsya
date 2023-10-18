<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Facility;
use App\Models\HostelImage;
use App\Models\HostelRoom;
use App\Models\HostelRoomFacility;
use App\Models\HostelRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ManagementHostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::with('hostelRoom')
            ->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate();
        return view('ekstranet.management-hostel.index', compact('hostels'));
    }

    public function detailhostel($id)
    {
        // $hostel = hostel::with('hostelRoom', 'hostelImage', 'hostelRating', 'hostelbookDate', 'hostelroomFacility', 'hostelRule')->find($id);
        $hostel = hostel::with('hostelRoom', 'hostelImage', 'Rating', 'hostelRule', 'hostelFacilities')->find($id);

        // $avg_rate = DB::table('hostel_ratings')->where('hostel_id', $id)->avg('rate');
        $avg_rate = DB::table('ratings')->where('hostel_id', $id)->avg('rate');

        $total_review = DB::table('ratings')->where('hostel_id', $id)->count();

        return view('ekstranet.management-hostel.detail-hostel', compact('hostel', 'avg_rate', 'total_review'));
    }
    public function settinghostel($id)
    {
        $hostel = hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('ekstranet.management-hostel.setting-hostel', compact('hostel'));
    }
    public function settingRoom($id)
    {
        $hostel = hostel::with('hostelRoom')->find($id);
        $hostelRoom = $hostel->hostelRoom;
        $hostelroomimage = $hostel->hostelroomImage;
        $facilities = Facility::all();
        $roomFacilitiesIds = $facilities->pluck('facility_id')->toArray();
        $responsJson = [
            'data' => [
                'hostel_room' => $hostelRoom,
                'facilities' => $facilities,
                'roomFacilitiesIds' => $roomFacilitiesIds,
            ],
        ];
        $data = $responsJson['data'];
        return view('ekstranet.management-hostel.setting-rooms', compact('hostel', 'facilities', 'data'));
    }


    public function settingRoomCreate($id)
    {
        $hostel = hostel::with('hostelRoom')->find($id);
        $facility = Facility::all();

        return view('ekstranet.management-hostel.setting-room-create', compact('hostel', 'facility'));
    }

    public function settingRoomPost(Request $request)
    {
        //$data = $request->all();
        //dd($data);
        $validator = Validator::make($request->all(), [
            'hostel_id' => 'required',
            'name' => 'required',
            // 'rentprice_monthly' => 'required',
            // 'sellingrentprice_monthly' => 'required',
            'totalroom' => 'required',
            'roomsize' => 'required',
            // 'maxextrabed' => 'required',
            // 'bed_type' => 'required',
            // 'guest' => 'required',
            // 'image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        //Ini validasi
        // $request->validate([
        //     'name' => 'required',
        //     'rentprice_monthly' => 'required',
        //     'sellingrentprice_monthly' => 'required',
        //     'totalroom' => 'required',
        //     'roomsize' => 'required',
        //     // 'maxextrabed' => 'required',
        //     'bed_type' => 'required',
        //     'guest' => 'required',
        //     // 'image_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $data = $request->only(['rentprice_monthly', 'sellingrentprice_monthly', 'rentprice_yearly', 'sellingrentprice_yearly']); // Ambil data dari request

        //Insetrt Data Baru
        $hostelRoom = hostelRoom::create([
            'hostel_id' => $request->hostel_id,
            'name' => $request->name,
            'rentprice_monthly' => str_replace('.', '', $request->rentprice_monthly),
            'sellingrentprice_monthly' => $request->sellingrentprice_monthly == null ? 0 : str_replace('.', '', $request->sellingrentprice_monthly),
            'rentprice_yearly' => str_replace('.', '', $request->rentprice_yearly),
            'sellingrentprice_yearly' => $request->sellingrentprice_yearly == null ? 0 : str_replace('.', '', $request->sellingrentprice_yearly),
            'roomsize' => $request->roomsize,
            'max_guest' => $request->guest,
            'maxextrabed' => $request->maxextrabed,
            // 'totalbathroom' => $request->totalbathroom,
            // 'maxextrabed' => $request->maxextrabed,
            'extrabedprice' => $request->extrabedprice == null ? 0 : str_replace('.', '', $request->extrabedprice),
            'extrabed_sellingprice' => $request->extrabedsellingprice == null ? 0 :  str_replace('.', '', $request->extrabedsellingprice),
            // 'bed_type' => $request->bed_type,
            'totalroom' => $request->totalroom,
            'is_active' => 1,

        ]);

        $hostelRoomImageFiles = $request->file('hostel_room_image', []);
        $hostel_id = $hostelRoom->hostel->id;

        foreach ($hostelRoomImageFiles as $imageFile) {
            $path = $imageFile->store('media/hostel/');
            $filename = basename($path);

            DB::table('hostel_room_images')->insert([
                'hostel_id' => $hostel_id,
                'hostel_room_id' => $hostelRoom->id, // Menggunakan ID dari kamar hostel yang baru saja dibuat
                'image' => 'media/hostel/' . $filename,
            ]);
        }


        $facilityIds = $request->input('facility_id', []);
        $roomId = $hostelRoom->id;

        foreach ($facilityIds as $facilityId) {
            DB::table('hostel_room_facilities')->insert([
                'hostel_id' => $request->hostel_id,
                'hostel_room_id' => $roomId,
                'facility_id' => $facilityId,
            ]);
        }

        //Ini untuk pemberitahuan
        toast('HostelRoom berhasil dibuat', 'success');
        return redirect()->back();
    }


    public function settingPhoto($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);
        return view('ekstranet.management-hostel.setting-photo', compact('hostel'));
    }

    public function storePhotoHostel($id, Request $request)
    {

        $file = $request->file('image');
        $fileName = $file->hashName();
        $file->storeAs('media/hostel', $fileName);

        HostelImage::create([
            'hostel_id' => $id,
            'image' => $fileName,
            'main' => 0
        ]);

        toast('Upload foto berhasil', 'success');
        return redirect()->back();
    }

    public function mainphotoHostel($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hostel_id'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $hostelImage = HostelImage::find($id);
        if ($hostelImage) {
            $hostelImage->where('hostel_id', $request->hostel_id)
                ->update([
                    'main' => 0
                ]);
            $hostelImage->update([
                'main' => 1,
            ]);

            toast('Foto Utama Hostel berhasil diperbarui', 'success');

            return redirect()->back();
        } else {
            return response()->json(['error' => 'Gambar Hostel tidak ditemukan'], 404);
        }
    }

    public function destroyphotoHostel($id)
    {

        $hostelImage = HostelImage::findOrFail($id);
        Storage::delete('media/hostel/' . $hostelImage->image);

        $hostelImage->delete();

        toast('Hostel Image has been deleted', 'success');
        return redirect()->back();
    }

    public function settingRoomShow($hostel_id, $id)
    {
        $hostelRoom = hostelRoom::where('id', $id)
            ->where('hostel_id', $hostel_id)
            ->first();

        if (!$hostelRoom) {
            return response()->json([
                'success' => false,
                'message' => 'Data Room Tidak Ditemukan',
                'data' => null,
            ]);
        }

        // Ambil data fasilitas (facility)
        $facilities = hostelRoomFacility::where('hostel_room_id', $hostelRoom->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Room',
            'data' => [
                'hostel_room' => $hostelRoom,
                'facilities' => $facilities,
            ],
        ]);
    }



    //ini aksi untuk update
    public function settingRoomUpdate(Request $request, $hostel_id, $id)
    {
        //dd($request->all());
        $hostelRoom = hostelRoom::where('id', $id)
            ->where('hostel_id', $hostel_id)
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

        if ($request->hasFile('image_1')) {
            $image_1 = $request->file('image_1');
            $image_1->storeAs('public/media/hostel', $image_1->hashName());

            Storage::delete('public/media/hostel', $hostelRoom->image_1);

            $hostelRoom->update([
                'hostel_id' => $request->hostel_id,
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
            DB::table('hostel_room_facilities')
                ->where('hostel_room_id', $hostelRoom->id)
                ->delete();

            // Tambahkan fasilitas yang baru
            foreach ($facilityIds as $facilityId) {
                DB::table('hostel_room_facilities')->insert([
                    'hostel_id' => $request->hostel_id,
                    'service_id' => 8,
                    'hostel_room_id' => $hostelRoom->id,
                    'facility_id' => $facilityId,
                ]);
            }
        } else {
            $hostelRoom->update([
                'hostel_id' => $request->hostel_id,
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
            DB::table('hostel_room_facilities')
                ->where('hostel_room_id', $hostelRoom->id)
                ->delete();

            // Tambahkan fasilitas yang baru
            foreach ($facilityIds as $facilityId) {
                DB::table('hostel_room_facilities')->insert([
                    'hostel_id' => $request->hostel_id,
                    'service_id' => 8,
                    'hostel_room_id' => $hostelRoom->id,
                    'facility_id' => $facilityId,
                ]);
            }
        }

        $updatedData = $hostelRoom->fresh();
        // Ambil fasilitas yang diperbarui
        $updatedFacilities = DB::table('hostel_room_facilities')
            ->where('hostel_room_id', $updatedData->id)
            ->get();

        toast('hostel Room Has Been Updated', 'success');

        return response()->json([
            'success' => true,
            'message' => 'Data hostelRoom Berhasil Diudapte!',
            'data' => [
                'updatedData' => $updatedData,
                'facilities' => $facilities,
                'updatedFacilities' => $updatedFacilities,
            ],
        ]);
    }

    public function settingRoomDelete(string $id)
    {
        hostelRoom::where('id', $id)->delete();
        hostelRoomFacility::where('hostel_room_id', $id)->delete();
        toast('hostel Has Been Removed', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }


    public function destroyRoom($id)
    {
        $hostel_room = hostelRoom::findOrFail($id);
        $hostel_room->delete();

        toast('hostel Room has been deleted', 'success');
        return redirect()->back();
    }

    public function destroyimage($id, hostelImage $hostelImage)
    {
        $hostelImage = hostelImage::findOrFail($id);
        Storage::delete('media/hostel/' . $hostelImage->image);

        $hostelImage->delete();


        toast('hostel Image has been deleted', 'success');
        return redirect()->back();
    }

    public function storeRule(Request $request)
    {
        $this->validate($request, [
            // 'hostel_id'  => 'required',
            'description'  => 'required'
        ]);

        hostelRule::create([
            'description'  => $request->description,
            'hostel_id' => $request->hostel_id,
        ]);
        toast('hostel Rule has been created', 'success');
        return redirect()->back();
    }

    public function showRule(Request $request)
    {
        $hostelRule = hostelRule::where('id', $request->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data hostel Rules',
            'data'    => $hostelRule
        ]);
    }

    public function updaterule(Request $request, hostelRule $hostelRule, $id)
    {
        $validator = Validator::make($request->all(), [
            'hostel_id'  => 'required',
            'description'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        $hostelRule = hostelRule::find($id);
        $hostelRule->update([
            'hostel_id'  => $request->hostel_id,
            'description'  => $request->description
        ]);

        toast('hostel Rule has been Updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $hostelRule
        ]);
        // return redirect()->back();
    }
    public function destroyRule($id)
    {
        $hostel_rule = hostelRule::findorfail($id);
        $hostel_rule->delete();
        toast('hostel Rule has been Deleted', 'success');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Rating;
use App\Models\HostelImage;
use App\Models\HostelRoom;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


class HostelController extends Controller
{
    public function index()
    {
        // $hostels = Hostel::with('hostelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        // $users = User::where('role',2)->get();

        // $users = User::with('hostel')
        //     ->where('role', 1)->get();
        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();

        $hostels = DB::table('hostels')
            ->join('users', 'users.id', '=', 'hostels.user_id')
            ->select('hostels.*', 'users.name as user_name')
            ->get();

        $ratings = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('hostels', 'hostels.id', '=', 'ratings.hostel_id')
            ->select('ratings.*', 'users.*', 'hostels.*')
            ->get();

        return view('admin.management-mitra.hostel.index', compact('hostels', 'users', 'ratings'));
    }


    public function show(Hostel $hostel)
    {
        // $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);
        // return view('admin.hostel-show', compact('hostel'));
        // $hostel = Hostel::find($request->id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $hostel
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'address' => 'required',
            'star' => 'required',
            'website' => 'required',
            'user_id' => 'required',
            'city' => 'required',
            // 'is_active' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::table('hostels')->insert([
            'name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'is_active' => 1,
            // 'service_id' => 7,
            'city' => $request->city,
            'kecamatan' => '-',
            'address' => $request->address,
            'description' => '-',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'star' => $request->star,
            'website' => $request->website,
            'property' => '-'
        ]);
        // Hostel::create([
        //     'name' => ucwords($request->name),
        //     'user_id' => $request->user_id,
        //     'is_active' => 1,
        //     'service_id' => 7,
        //     'city' => $request->city,
        //     'kecamatan' => '-',
        //     'address' => $request->alamat,
        //     'description' => '-',
        //     'facilities' => '-',
        //     'lat' => '-',
        //     'lon' => '-',
        //     'category' => 'Harian',
        //     'checkin' => '11:00',
        //     'checkout' => '12:00',
        //     'star' => $request->star,
        //     'website' => $request->website,
        //     'property' => '-']);

        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    public function get(Request $request)
    {
        // Cari data TPS berdasarkan ID
        $hostels = Hostel::find($request->id);

        // Jika data TPS ditemukan, kembalikan response JSON dengan data TPS
        if ($hostels) {
            return response()->json(['hostel' => $hostels]);
        } else {
            // Jika data TPS tidak ditemukan, kembalikan response JSON dengan pesan error
            return response()->json(['message' => 'TPS not found'], 404);
        }
    }

    public function mainImage(Request $request)
    {
        $hostel = HostelImage::where('hostel_id', $request->hostelid)->where('main', 1)->update(['main' => 0]);
        $image = HostelImage::find($request->id)->update(['main' => 1]);

        toast('Image has been updated', 'success');
        return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        HostelImage::find($request->id)->delete();
        toast('Image has been deleted', 'warning');
        return redirect()->back();
    }

    public function edit($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);
        return view('admin.hostel-edit', compact('hostel'));
    }

    public function update(Request $request, Hostel $hostel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'star' => 'required',
            // 'user_id' => 'required',
            'city' => 'required',
            'is_active' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // //check if validation fails
        DB::table('hostels')->where('id', $hostel->id)->update([
            'user_id' => $request->user_id,
            'is_active' => $request->is_active,
            // 'service_id' => 7,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'star' => $request->star,
            'website' => $request->website,

        ]);
        // $hostel->update([
        //     'user_id' => $request->user_id,
        //     'is_active' => 1,
        //     'checkin' => "11:00",
        //     'checkout' => "12:00",
        //     'service_id' => 7,
        //     'name' => $request->name,
        //     'address' => $request->address,
        //     'city' => $request->city,
        //     'star' => $request->star,
        //     'website' => $request->website,
        // ]);


        toast('Hostel has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $hostel
        ]);
    }

    public function showImage($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);
        return view('admin.hostel-image', compact('hostel'));
    }

    public function storeImage(Request $request)
    {
        $request->validate([
            "id" => "required",
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $hostel = Hostel::find($request->id);

        $destinationPath = 'media/hostel';



        for ($i = 0; $i < count($request->image); $i++) {
            $myimage = url($destinationPath) . '/' . $request->image[$i]->hashName();
            $request->image[$i]->move(public_path($destinationPath), $myimage);
            // dd($request->all(), $request->file('image')[$i]);
            //            $request->file('image')[$i]->storeAs(
            //                'hostel/' . Str::slug($hostel->name, '-'),
            //                Str::slug($hostel->name) . '-' . time() + $i . '.' . $request->file('image')[$i]->getClientOriginalExtension(),
            //                'public',
            //            );
            HostelImage::create([
                'hostel_id' => $request->id,
                'image' => $myimage,
                'main' => 0
            ]);
        }
        toast('Hostel has been updateds', 'success');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $hostels = Hostel::findOrFail($id);
        $hostels->delete();

        toast('Hostel has been deleted', 'success');
        return redirect()->back();
    }


    public function updateAjax(Request $request, Hostel $hostel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $hostel = Hostel::update([
            'name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'is_active' => 1,
            'city' => $request->city,
            'kecamatan' => '-',
            'address' => $request->alamat,
            'category' => $request->category,
            'description' => '-',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'star' => $request->star,
            'website' => $request->website,
            'property' => '-'
        ]);


        toast('Hostel has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $hostel
        ]);
    }

    public function review(Request $request, $hostel_id)
    {

        $query = DB::table('ratings')
            ->join('users', 'users.id', '=', 'ratings.user_id')
            ->join('hostels', 'hostels.id', '=', 'ratings.hostel_id')
            ->join('transactions', 'transactions.id', '=', 'ratings.transaction_id')
            ->where('ratings.hostel_id', $hostel_id);

        if ($request->has('rate')) {
            $query->where('ratings.rate', $request->rate);
        }

        $ratings = $query->select('ratings.*', 'ratings.created_at as createdat', 'users.name as user_name', 'hostels.*', 'transactions.id as transaction_id')->get();

        $avg_rate = DB::table('ratings')->where('hostel_id', $hostel_id)->avg('rate');

        $total_review = DB::table('ratings')->where('hostel_id', $hostel_id)->count();

        $ratingCounts = [
            '5' => $query->where('rate', 5)->count(),
            '4' => $query->where('rate', 4)->count(),
            '3' => $query->where('rate', 3)->count(),
            '2' => $query->where('rate', 2)->count(),
            '1' => $query->where('rate', 1)->count(),
        ];



        return view('admin.management-mitra.rating.index', compact('ratings', 'hostel_id', 'avg_rate', 'total_review', 'ratingCounts'));
    }
}

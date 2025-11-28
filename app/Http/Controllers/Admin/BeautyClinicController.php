<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeautyClinicController extends Controller
{

    public function index()
    {
        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();

        $clinics = DB::table('clinics')
            ->join('users', 'clinics.user_id', '=', 'users.id')
            ->join('cities', 'clinics.city', '=', 'cities.city_id')

            ->select(
                'clinics.id as clinic_id',
                'clinics.phone as clinic_phone',
                'clinics.is_active as clinic_active',
                'clinics.*',
                'users.id as user_id',
                'users.*',
                'cities.city_id as city_id',
                'cities.image as city_image',
                'cities.*',

            )
            ->get();

        $cities = City::all();

        $packages = DB::table('clinic_has_packages')
            ->join('categories_services', 'clinic_has_packages.categories_services_id', '=', 'categories_services.id')
            ->select('categories_services.name as category_name')
            ->get();

        // dd($clinics);

        return view('admin.management-mitra.klinik-kecantikan.index', compact('users', 'clinics', 'cities', 'packages'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'nullable',
            'city' => 'nullable',
            'address' => 'nullable',
            'open' => 'nullable',
            'close' => 'nullable',
            'description' => 'nullable',
            'highlight' => 'nullable',
            'lat' => 'nullable',
            'ltd' => 'nullable',
            'category' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validasi untuk file gambar (10MB)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $clinic = new Clinic();
        $clinic->clinic_name = $request->input('name');
        $clinic->user_id = $request->input('user_id');
        $clinic->city = $request->input('city');
        $clinic->phone = $request->input('phone');
        $clinic->address = $request->input('address');
        $clinic->open = $request->input('open');
        $clinic->close = $request->input('close');
        $clinic->description = $request->input('description');
        $clinic->highlight = $request->input('highlight');
        $clinic->lat = $request->input('lat');
        $clinic->ltd = $request->input('ltd');
        $clinic->is_active = 1; // Assuming new clinics are active by default
        $clinic->category = $request->input('category');
        $clinic->save();

        // Handle image upload jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('clinics', 'public');

            // Simpan gambar ke tabel clinic_images dan tandai sebagai gambar utama
            $clinic->images()->create([
                'image' => $imagePath,
                'main' => 1
            ]);
        }


        toast('Mitra has been created', 'success');
        return redirect()->back();
    }

    public function show(string $id)
    {

        $clinic = Clinic::findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    =>  $clinic
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'nullable',
            'city' => 'nullable',
            'address' => 'nullable',
            'open' => 'nullable',
            'close' => 'nullable',
            'description' => 'nullable',
            'highlight' => 'nullable',
            'lat' => 'nullable',
            'ltd' => 'nullable',
            'is_active' => 'nullable',
            'category' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Validasi untuk file gambar (10MB)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $clinic = Clinic::findOrFail($id);

        $clinic->update([
            'user_id' => $request->user_id,
            'clinic_name' => ucwords($request->name),
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'open' => $request->open,
            'close' => $request->close,
            'description' => $request->description,
            'highlight' => $request->highlight,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
            'is_active' => $request->is_active,
            'category' => $request->category,
        ]);

        // Handle image upload jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            $oldImage = $clinic->image; // Ambil gambar utama lama
            if ($oldImage) {
                $oldImagePath = storage_path('app/public/' . $oldImage->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                // Hapus record gambar lama dari database
                $oldImage->delete();
            }

            $image = $request->file('image');
            $imagePath = $image->store('clinics', 'public');

            // Simpan gambar baru ke tabel clinic_images dan tandai sebagai gambar utama
            $clinic->images()->create([
                'image' => $imagePath,
                'main' => 1
            ]);
        }


        toast('Mitra has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $clinic
        ]);
    }

    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        toast('Clinic has been deleted', 'success');
        return redirect()->back();
    }
}

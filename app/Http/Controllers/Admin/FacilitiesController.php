<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.management-facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Simpan gambar dengan nama yang di-hash
            $image->storeAs('public/facilities/', $image->hashName());
            
            // Lanjutkan dengan logika lain terkait pengunggahan file jika ada
        } else {
            return response()->json(['error' => 'Tidak ada file yang diunggah'], 422);
        }

        Facility::create([
            'icon' => $image->hashName(),
            'name' => $request->name,
        ]);

        toast('Facilities has been created', 'success');
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $facility,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facilities = Facility::findorFail($id);
        return view('admin.management-facilities.edit', compact('facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'icon' => 'required'

        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/facilities/', $image->hashName());

            //delete old image
            Storage::delete('public/facilities/' . $facility->image);

            DB::table('facilities')->where('id', $facility->id)->update([
                'icon' => $image->hashName(),
                'name' => $request->name,
            ]);
        } else {
            DB::table('facilities')->where('id', $facility->id)->update([
                'name' => $request->name,
            ]);
        }



        toast('Facilities has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $facility
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        Storage::delete('public/facilities/' . $facility->image);
        $facility->delete();

        toast('Facilities has been deleted', 'success');
        return redirect()->back();
    }
}

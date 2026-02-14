<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::all();
        return view('admin.management-ads.index', compact('ads'));
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
        // dd($request->file('image'));
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()->with('openModal', true);
        }

        // if ($validator->fails()) {
            
        //     return response()->json($validator->errors(), 422);
        // }

        if ($request->hasFile('image')) {
           $img = $request->file('image');
           $imgName = time() . '_' .$img->getClientOriginalName();
           $img->move(public_path('media/ads'), $imgName);
        }
        Ad::create([
         'name'  => $request->name,
         'url'   => $request->url,
         'image' => $imgName,
         'is_active' => $request->is_active
        ]);

        toast('Ads has been created', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $ad
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $imgName = $ad->image;

        if($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . '_' .$img->getClientOriginalName();
            $img->move(public_path('media/ads'), $imgName);

            $imgPath = public_path('/media/ads/' . $ad->image);
            if(File::exists($imgPath)) {
                File::delete($imgPath);
            };
        }

        $ad->update([
            'name'  => $request->name,
            'url'   => $request->url,
            'image' => $imgName,
            'is_active' => $request->is_active
        ]);

        // if ($request->hasFile('image')) {

        //     //upload new image
        //     $image = $request->file('image')->store('media/ads');
        //     // $image->storeAs('media/ads', $image->hashName(), 'public');

        //     Storage::delete('media/ads/'.$ad->image);

        //     $ad->update([
        //         'image'     => $image,
        //         'name'     => $request->name,
        //         'url'   => $request->url,
        //         'is_active' => $request->is_active,
        //     ]);

        // } else {

        //     //update post without image
        //     $ad->update([
        //         'name'     => $request->name,
        //         'url'   => $request->url,
        //         'is_active' => $request->is_active,
        //     ]);
        // }



        toast('Ads has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $ad
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        $imgPath = public_path('/media/ads/' . $ad->image);

        if(File::exists($imgPath)) {
            File::delete($imgPath);
        }

        $ad->delete();



        toast('Ads has been deleted', 'success');
        return redirect()->back();
    }



}

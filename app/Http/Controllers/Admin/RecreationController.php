<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recreation;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\recreationImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecreationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
        ->select('users.*')
        ->where('role', 1)
        ->get();

        $category = DB::table('category_recreations')->get();

        $recreations = DB::table('recreations')
        ->join('users', 'recreations.user_id', '=', 'users.id')
        ->join('cities', 'recreations.city', '=', 'cities.city_id')
        ->join('category_recreations', 'recreations.category_recreation_id', '=', 'category_recreations.id')
        ->select(
            'recreations.id as recreation_id',
            'recreations.*',
            'recreations.phone as recreation_phone',
            'recreations.is_active as recreation_status',
            'category_recreations.name as category_name',
            'users.id as user_id',
            'users.*',
            'cities.city_id as city_id',
            'cities.image as city_image',
            'cities.*'
        )
        ->get();

        $cities = City::all();


        return view('admin.management-mitra.rekreasi.index', compact('users', 'recreations', 'cities', 'category'));
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
            'user_id' => 'required',
            'phone' => 'required',
            'lat' => 'nullable',
            'ltd' => 'nullable',
            'city' => 'required',
            'category_recreation_id' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()->with('openModal', true);;
        }

        DB::beginTransaction();

        try {
            $recreationId = DB::table('recreations')->insertGetId([
                'business_name' => ucwords($request->name),
                'category_recreation_id' => $request->category_recreation_id,
                'user_id' => $request->user_id,
                'city' => $request->city,
                'phone' => $request->phone,
                'lat' => $request->lat,
                'ltd' => $request->ltd,
                'address' => $request->address,
                'is_active' => 1,
            ]);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imgName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('recreation', $imgName, 'public');
                recreationImages::create([
                    'recreation_id' => $recreationId,
                    'image' => $imgName
                ]);
            }

            DB::commit();

            toast('Mitra has been created', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toast('Mitra creation failed. Please try again.', 'error');
            return redirect()
                ->back()
                ->withInput();
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recreation = Recreation::findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    =>  $recreation
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
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'phone' => 'required',
            'lat' => 'nullable',
            'ltd' => 'nullable',
            'city' => 'required',
            'address' => 'required',
            'is_active' => 'required',
            'category_recreation_id' => 'required|exists:category_recreations,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $recreation = Recreation::findOrFail($id);
        $recreation->update([
            'user_id' => $request->user_id,
            'business_name' => ucwords($request->name),
            'category_recreation_id' => $request->category_recreation_id,
            'city' => $request->city,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->is_active,
        ]);


        toast('Mitra has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $recreation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recreation = Recreation::findOrFail($id);
        $recreation->delete();

        toast('Mitra has been deleted', 'success');
        return redirect()->back();
    }
}

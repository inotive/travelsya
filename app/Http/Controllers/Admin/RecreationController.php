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

        $recreations = Recreation::with([
            'user',
            'kota',
            'categoryRecreation',
            'image' => function($q) {
                $q->where('main', 1);
            }
        ])
        ->get()
        ->map(function($recreation) {
            return (object)[
                'recreation_id'      => $recreation->id,
                'business_name'      => $recreation->business_name,
                'category_recreation_id' => $recreation->category_recreation_id,
                'user_id'            => $recreation->user_id,
                'city'               => $recreation->city,
                'lat'                => $recreation->lat,
                'ltd'                => $recreation->ltd,
                'phone'              => $recreation->phone,
                'recreation_phone'   => $recreation->phone,
                'address'            => $recreation->address,
                'description'        => $recreation->description,
                'open'               => $recreation->open,
                'close'              => $recreation->close,
                'is_active'          => $recreation->is_active,
                'recreation_status'  => $recreation->is_active,
                'category_name'      => optional($recreation->categoryRecreation)->name,
                'name'               => optional($recreation->user)->name,
                'email'              => optional($recreation->user)->email,
                'city_id'            => optional($recreation->kota)->city_id,
                'city_name'          => optional($recreation->kota)->city_name,
                'city_image'         => optional($recreation->kota)->image,
                'images'             => optional($recreation->image)->image ?? '-',
            ];
        });

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
            'name' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'ltd' => 'nullable|numeric',
            'city' => 'nullable|string',
            'category_recreation_id' => 'nullable|exists:category_recreations,id',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'open' => 'nullable|date_format:H:i',
            'close' => 'nullable|date_format:H:i',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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
                'category_recreation_id' => $request->category_recreation_id ?? null,
                'user_id' => $request->user_id,
                'city' => $request->city ?? null,
                'phone' => $request->phone ?? null,
                'lat' => $request->lat ?? null,
                'ltd' => $request->ltd ?? null,
                'address' => $request->address ?? null,
                'description' => $request->description ?? null,
                'open' => $request->open ?? null,
                'close' => $request->close ?? null,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imgName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('recreation', $imgName, 'public');
                recreationImages::create([
                    'recreation_id' => $recreationId,
                    'image' => "recreation/" . $imgName,
                    'main' => 1
                ]);
            }

            DB::commit();

            toast('Mitra has been created', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the actual error for debugging
            \Log::error('Recreation creation failed: ' . $e->getMessage());

            toast('Mitra creation failed: ' . $e->getMessage(), 'error');
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
        $recreation = Recreation::with('image')->findOrFail($id);

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
            'name' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string',
            'lat' => 'nullable|numeric',
            'ltd' => 'nullable|numeric',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'open' => 'nullable|date_format:H:i',
            'close' => 'nullable|date_format:H:i',
            'is_active' => 'nullable|boolean',
            'category_recreation_id' => 'nullable|exists:category_recreations,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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
            'description' => $request->description,
            'open' => $request->open,
            'close' => $request->close,
            'is_active' => $request->is_active,
        ]);

        // Handle image upload if provided
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('recreation', $imgName, 'public');

            // Update or create recreation image
            recreationImages::updateOrCreate(
                ['recreation_id' => $recreation->id, 'main' => 1],
                ['image' => "recreation/" . $imgName]
            );
        }

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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recreation;
use App\Models\City;
use App\Http\Controllers\Controller;
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

        $recreations = DB::table('recreations')
        ->join('users', 'recreations.user_id', '=', 'users.id')
        ->select(
            'recreations.id as recreation_id', 
            'recreations.*', 
            'users.id as user_id', 
            'users.*'
        )
        ->get();

        $cities = City::all();


        return view('admin.management-mitra.rekreasi.index', compact('users', 'recreations', 'cities'));
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
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::table('recreations')->insert([
            'business_name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => 1,
        ]);

        toast('Mitra has been created', 'success');
        return redirect()->back();
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
            'city' => 'required',
            'address' => 'required',
            'is_active' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $recreation = Recreation::findOrFail($id);
        $recreation->update([
            'user_id' => $request->user_id,
            'business_name' => ucwords($request->name),
            'city' => $request->city,
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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeautyClinicController extends Controller
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

        $clinics = DB::table('clinics')
        ->join('users', 'clinics.user_id', '=', 'users.id')
        ->select(
            'clinics.id as clinic_id', 
            'clinics.*', 
            'users.id as user_id', 
            'users.*'
        )
        ->get();


        return view('admin.management-mitra.klinik-kecantikan.index', compact('users', 'clinics'));
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

        DB::table('clinics')->insert([
            'clinic_name' => ucwords($request->name),
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

        $clinic = Clinic::findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    =>  $clinic
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

        DB::table('clinics')->where('id', $id)->update([
            'clinic_name' => ucwords($request->name),
            'user_id' => $request->user_id,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => 1,
        ]);

        toast('Mitra has been updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        toast('Clinic has been deleted', 'success');
        return redirect()->back();
    }
}

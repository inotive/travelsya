<?php

namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
use Illuminate\Support\Facades\DB;
class BeautyClinicController extends Controller
{
    public function index(Request $request) {
        
        $clinics = Clinic::with('clinicPackages')->get();

        return view('clinic.list', compact('clinics',));
    }


    public function show(string $id)
{
    // Ensure 'package' is defined or remove it if not needed
    $clinic = Clinic::with('clinicPackages')->findOrFail($id);
    
    // Correct the compact statement
    return view('clinic.detail', compact('clinic'));
}


    public function reservation(Request $request) {
    
        return view('clinic.reservation');
    }

    public function ajaxCity()
    {
        $clinicCity = Clinic::distinct()->select('city')->get();

        return response()->json(($clinicCity));
    }


    // Create new clinic service
    public function create() {
        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();
    
        $categories = CategoriesServices::all(); // Fetch all categories
        $clinics = Clinic::all(); // Fetch all clinics
    
        return view('clinic.create', compact('users', 'categories', 'clinics'));
    }
    

    // Store new clinic service
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'clinic_id' => 'required',
            'clinic_has_package_id' => 'required',
            'expiry_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $clinic = new Clinic();
        $clinic->name = $request->input('name');
        if ($request->hasFile('image')) {
            $clinic->image = $request->file('image')->store('images', 'public');
        }
        $clinic->clinic_id = $request->input('clinic_id');
        $clinic->clinic_has_package_id = $request->input('clinic_has_package_id');
        $clinic->expiry_date = $request->input('expiry_date');
        $clinic->price = $request->input('price');
        $clinic->save();

        return redirect()->route('clinic.list')->with('success', 'Clinic service added successfully.');
    }


    // Edit clinic service
    public function edit($id) {
        //
    }

    
}

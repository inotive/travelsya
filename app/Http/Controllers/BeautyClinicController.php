<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\City;
use Illuminate\Support\Facades\DB;
class BeautyClinicController extends Controller
{
    public function index(Request $request) {
        return view('clinic.list-clinic');
    }


    public function show(string $id) {
        return view('clinic.show');
    }


    public function reservation(Request $request) {
    
        return view('clinic.reservation');
    }

    public function ajaxCity()
    {
        $clinicCity = Clinic::distinct()->select('city')->get();

        return response()->json(($clinicCity));
    }

    public function list ()
    {
        $users = DB::table('users')
        ->select('users.*')
        ->where('role', 1)
        ->get();

        $cities = City::all();

        $clinics = DB::table('detail_order_clinics')->get();

        return view('ekstranet.klinik.list-klinik', compact('users', 'clinics','cities'));
    }


    // Create new clinic service
    public function create() {
        //
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

        return redirect()->route('clinics.list')->with('success', 'Clinic service added successfully.');
    }

    // Edit clinic service
    public function edit($id) {
        //
    }

    // Update clinic service
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'clinic_id' => 'required',
            'clinic_has_package_id' => 'required',
            'expiry_date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $clinic = Clinic::findOrFail($id);
        $clinic->name = $request->input('name');
        if ($request->hasFile('image')) {
            $clinic->image = $request->file('image')->store('images', 'public');
        }
        $clinic->clinic_id = $request->input('clinic_id');
        $clinic->clinic_has_package_id = $request->input('clinic_has_package_id');
        $clinic->expiry_date = $request->input('expiry_date');
        $clinic->price = $request->input('price');
        $clinic->save();

        return redirect()->route('clinics.list')->with('success', 'Clinic service updated successfully.');
    }

    // Delete clinic service
    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        toast('Clinic has been deleted', 'success');
        return redirect()->back();
    }

}

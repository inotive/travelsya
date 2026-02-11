<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicHasPackages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::with(['kota', 'reviews'])->where('user_id', Auth::id())->get();
        
        return view('ekstranet.management-clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic = Clinic::with('kota')->where('user_id', Auth::id())->findOrFail($id);
        
        return view('ekstranet.management-clinic.show', compact('clinic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clinic = Clinic::where('user_id', Auth::id())->findOrFail($id);
        
        // Get all cities for the dropdown
        $cities = \App\Models\City::all();
        
        return view('ekstranet.management-clinic.edit', compact('clinic', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clinic = Clinic::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'clinic_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'city' => 'required|integer',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'description' => 'required|string',
            'open' => 'required',
            'close' => 'required',
            'is_active' => 'required|boolean',
            'highlight' => 'nullable|string',
            'lat' => 'required|numeric',
            'ltd' => 'required|numeric',
        ]);

        $clinic->update([
            'clinic_name' => $request->clinic_name,
            'category' => $request->category,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'open' => $request->open, // Changed from open_time to open to match clinic table
            'close' => $request->close, // Changed from close_time to close to match clinic table
            'is_active' => $request->is_active,
            'highlight' => $request->highlight,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
        ]);

        return redirect()->route('partner.management.clinic')->with('success', 'Klinik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Display clinic packages
     *
     * @return \Illuminate\Http\Response
     */
    public function clinicPaket()
    {
        $query = ClinicHasPackages::with(['clinic', 'categoriesService', 'specialist', 'image'])
            ->join('clinics', 'clinic_has_packages.clinic_id', '=', 'clinics.id')
            ->where('clinics.user_id', Auth::id())
            ->select('clinic_has_packages.*');
            
        // Filter by specific clinic if clinic_id is provided in the request
        $selectedClinicId = null;
        if (request()->has('clinic_id') && request()->get('clinic_id') != '') {
            $query->where('clinic_has_packages.clinic_id', request()->get('clinic_id'));
            $selectedClinicId = request()->get('clinic_id');
        }
        
        $clinics = $query->get();
        
        // Get additional data needed by the view
        $spesialis = \App\Models\Specialist::all();
        $users = \App\Models\User::all();
        $cities = \App\Models\City::all();
        $categories = \App\Models\CategoriesServices::all();
        
        // Get user's clinics for the dropdown
        $userClinics = \App\Models\Clinic::where('user_id', Auth::id())->get();
        
        return view('ekstranet.jasaklinik.list-klinik', compact('clinics', 'spesialis', 'users', 'cities', 'categories', 'userClinics', 'selectedClinicId'));
    }
}
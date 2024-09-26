<?php
namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
use App\Models\Specialist; // Pastikan ada model Specialist
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClinicHasPackageController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();

        $cities = City::all();

        $clinics = DB::table('clinic_has_packages')
            ->select('clinic_id', 'categories_services_id', 'name', 'duration', 'price', 'description', 'is_active', 'specialist_id')
            ->paginate(10);

        $data = ClinicHasPackages::select('clinic_id', 'categories_services_id', 'name', 'duration', 'price', 'description')
            ->get();
        
        $categories = CategoriesServices::all();

        $spesialis = Specialist::all(); 

        $clinics = ClinicHasPackages::with(['specialist', 'Specialist'])->get();


        // Debugging (opsional untuk memastikan data diambil dengan benar):
        //dd($clinics);

        return view('ekstranet.klinik.list-klinik', compact('spesialis', 'users', 'clinics', 'cities','categories'));

    }

    public function create(){

        
        $categories = CategoriesServices::all();
        $spesialis = Specialist::all(); 

        $clinics = Clinic::all();

        return view('ekstranet.klinik.create-klinik', compact('spesialis','categories','clinics'));
    }

        
    public function store(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     'clinic_id' => 'required|integer',
        //     'categories_services_id' => 'required|integer',     
        //     'specialist_id' => 'required|integer', 
        //     'name' => 'required|string|max:255', 
        //     'rules' => 'required|string|max:255', 
        //     'description' => 'required|string', 
        //     'duration' => 'required|string|max:255', 
        //     'unit_price' => 'required|string|max:255', 
        //     'expiry_date' => 'required|date', 
        //     'price' => 'required|numeric',
        //     'is_active' => 'required|boolean',
        // ]);


        $clinic = new ClinicHasPackages();
        $clinic->clinic_id = $request->input('clinic_id');
        $clinic->name = $request->input('name');
        $clinic->rules = $request->input('rules');
        $clinic->specialist_id = $request->input('specialist_id');
        $clinic->clinic_id = $request->input('clinic_id');
        $clinic->categories_services_id = $request->input('categories_services_id');
        $clinic->duration = $request->input('duration');
        $clinic->description = $request->input('description');
        $clinic->price = $request->input('price');
        $clinic->unit_price = $request->input('unit_price');
        $clinic->expiry_date = $request->input('expiry_date');
        $clinic->is_active = $request->input('is_active');
        $clinic->save();

        return redirect()->route('clinics.index')->with('success', 'Clinic service added successfully.');

    }


        // Mengupdate data klinik
        public function update(Request $request, $id) {
            $clinic = ClinicHasPackages::find($id); // Ambil data klinik berdasarkan ID
        //dd($request->all());

            if (!$clinic) {
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }
        
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'specialist_id' => 'required|integer',
                'categories_services_id' => 'required|integer',
                'clinic_id' => 'required|integer',
                'rules' => 'required|string',
                'duration' => 'required|string',
                'unit_price' => 'required|string',
                'expiry_date' => 'required|date',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'is_active' => 'required|boolean',
            ]);
        
            // Update data klinik
            $clinic->update([
                'name' => $request->name,
                'specialist_id' => $request->specialist_id,
                'categories_services_id' => $request->categories_services_id,
                'clinic_id' => $request->clinic_id,
                'rules' => $request->rules,
                'duration' => $request->duration,
                'unit_price' => $request->unit_price,
                'expiry_date' => $request->expiry_date,
                'description' => $request->description,
                'price' => $request->price,
                'is_active' => $request->is_active,
            ]);
        
            return redirect()->route('clinics.index')->with('success', 'Klinik berhasil diperbarui.');
        }
        

        // Menghapus data klinik
                public function destroy($id)
        {
            $clinic = ClinicHasPackages::find($id); 

            if ($clinic) {
                $clinic->delete(); 
                return redirect()->route('clinics.index')->with('success', 'Klinik berhasil dihapus.');
            } else {
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }
        }


        public function edit($id) {
            $clinic = ClinicHasPackages::find($id); // Ambil data klinik berdasarkan ID
            $categories = CategoriesServices::all();
            $spesialis = Specialist::all(); 
        

            if (!$clinic) {
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }
        
            return view('ekstranet.klinik.edit-klinik', compact('clinic', 'spesialis', 'categories'));
        }
        


            public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }

    public function categoriesService()
    {
        return $this->belongsTo(CategoriesServices::class, 'categories_services_id');
    }

}

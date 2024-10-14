<?php
namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
use App\Models\Specialist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Models\CategoryService;

class ClinicHasPackageController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan user_id dari request atau session (sesuaikan sesuai logika aplikasi Anda)
        $userId = $request->input('user_id') ?? auth()->user()->id;

        // Ambil semua user dengan role 1 (misalnya untuk admin atau dokter klinik)
        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();

        // Ambil semua data kota
        $cities = City::all();

        // Ambil data klinik beserta paket layanan, kategori, dan spesialis berdasarkan user_id
        // Menggunakan eager loading untuk relasi dengan categoriesService dan specialist
        $clinics = ClinicHasPackages::with(['categoriesService', 'specialist'])
            ->whereHas('clinic', function($query) use ($userId) {
                $query->where('user_id', $userId);  // Filter berdasarkan user_id
            })
            ->paginate(10);

        // Ambil data kategori layanan
        $categories = CategoriesServices::all();

        // Ambil data spesialis
        $spesialis = Specialist::all();

        // Return data ke view 'list-klinik'
        return view('ekstranet.jasaklinik.list-klinik', compact('spesialis', 'users', 'clinics', 'cities', 'categories'));
    }

    public function create()
    {
        $categories = CategoriesServices::all();
        $spesialis = Specialist::all(); 
        $clinics = Clinic::all();

        // Memastikan bahwa ada setidaknya satu klinik
        if ($clinics->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada klinik yang tersedia.');
        }

        return view('ekstranet.jasaklinik.create-klinik', compact('spesialis', 'categories', 'clinics'));
    }

        
    public function store(Request $request)
    {
        //dd($request->all());

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
        //    'duration_type' => 'required|enum',

        //]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/clinichaspackages', $imageName);
        }

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
        $clinic->image = $imageName;
        $clinic->duration_type = $request->input('duration_type');
        $clinic->save();

        toast('Jasa Kecantikan berhasil ditambahkan', 'success');
        return redirect()->route('clinics.list');

    }


        // Mengupdate data klinik
        public function update(Request $request, $id) {
            $clinic = ClinicHasPackages::find($id); // Ambil data klinik berdasarkan ID

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
                'expiry_date' => 'required|integer',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'is_active' => 'required|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'duration_type' => 'required|string',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image
                if ($clinic->image) {
                    Storage::delete('public/clinichaspackages/' . $clinic->image);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/clinichaspackages', $imageName);
                $validatedData['image'] = $imageName;
            } else {
                // If no new image is uploaded, keep the old image
                $validatedData['image'] = $clinic->image;
            }

            // Update data klinik
            $clinic->update($validatedData);
            toast('Jasa Kecantikan berhasil diperbarui', 'success');
            return redirect()->route('clinics.list');
        }
        

        // Menghapus data klinik
        public function destroy($id)
        {
            $clinic = ClinicHasPackages::find($id); 

            if ($clinic) {
                $clinic->delete(); 
                toast('Jasa Kecantikan berhasil dihapus', 'success');
                return redirect()->route('clinics.list');
            } else {
                toast('Jasa Kecantikan tidak ditemukan', 'error');
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }
        }


        public function edit($id) {
            $clinic = ClinicHasPackages::find($id); // Ambil data klinik berdasarkan ID tanpa join table clinic
            $categories = CategoriesServices::all();
            $spesialis = Specialist::all(); 
            $clinics = Clinic::all(); // Ambil semua data klinik untuk dropdown pilihan klinik
        
            if (!$clinic) {
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }
            
            return view('ekstranet.jasaklinik.edit-klinik', compact('clinic', 'spesialis', 'categories', 'clinics'));
        }
        
        public function show($id) {
            $clinic = DB::table('clinic_has_packages')
                ->join('clinics', 'clinic_has_packages.clinic_id', '=', 'clinics.id')
                ->join('categories_services', 'clinic_has_packages.categories_services_id', '=', 'categories_services.id')
                ->where('clinic_has_packages.id', $id)
                ->select('clinic_has_packages.*', 'categories_services.name as category_name', 'clinics.clinic_name as clinic_name')
                ->first();
    
            if ($clinic) {
                return response()->json($clinic);
            } else {
                return response()->json(['message' => 'Data tidak ditemukan atau Anda tidak memiliki akses.'], 404);
            }
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

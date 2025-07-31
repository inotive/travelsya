<?php

namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
use App\Models\ClinicPackageImages;
use App\Models\Service;
use App\Models\Specialist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicHasPackageController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan user_id dari request atau session
        $userId = $request->input('user_id') ?? auth()->id();

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
            ->whereHas('clinic', function ($query) use ($userId) {
                $query->where('user_id', $userId);  // Filter berdasarkan user_id
            })
            ->get();
        // dd($clinics);

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

        return view('ekstranet.jasaklinik.create-klinik', compact('spesialis', 'categories', 'clinics'));
    }


    public function store(Request $request)
    {
        dd($request);

        $request->validate([
            'clinic_id' => 'required|integer',
            'categories_services_id' => 'required',
            'specialist_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'rules' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'unit_price' => 'required|string|max:255',
            'expiry_date' => 'required',
            'price' => 'required',
            'is_active' => 'required|boolean',
           'duration_type' => 'required|in:jam,menit',
           'images' => 'required|array',
           'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        DB::beginTransaction();
        try {
            $price = (int) preg_replace('/[^\d]/', '', $request->price);



            if(is_string($request->categories_services_id)) {
                $existingService  = CategoriesServices::where('name', $request->categories_services_id)->first();
                if(!$existingService) {
                    $newService = CategoriesServices::create(['name' => $request->categories_services_id]);
                    $request['categories_services_id'] = $newService->id;
                }
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
            $clinic->price = $price;
            $clinic->unit_price = $request->input('unit_price');
            $clinic->expiry_date = $request->input('expiry_date');
            $clinic->is_active = $request->input('is_active');
            // $clinic->image = $imageName;
            // $clinic->duration_type = $request->input('duration_type');
            $clinic->save();

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $imagePath = $image->store('images/clinic_package_images', 'public');
                    
                    // Set the first image as main image
                    $isMain = ($key === 0) ? 1 : 0;
                    
                    // Get the ID explicitly to avoid undefined property error
                    $clinicId = $clinic->id ?? null;
                    
                    ClinicPackageImages::create([
                        'clinic_package_id' => $clinicId,
                        'image' => $imagePath,
                        'main' => $isMain
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('clinics.list')->with('success', 'Clinic service added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Failed to add clinic service. Please try again.', 'e' => $e->getMessage()])
                ->withInput();
        }

        
    }


    // Mengupdate data klinik
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_services_id' => 'required', // Memastikan kategori yang dipilih ada
            'clinic_id' => 'nullable', // Memastikan klinik yang dipilih ada
            'rules' => 'required|string',
            'duration_type' => 'required|in:menit,jam', // Pastikan nilai duration_type valid
            'duration' => 'nullable',
            'unit_price' => 'nullable|string',
            'expiry_date' => 'nullable|integer', // Validasi agar tanggal tidak lebih dari hari ini
            'description' => 'required|string',
            'price' => 'required', // Validasi harga minimal 0
            'is_active' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk multiple images
        ]);

        DB::beginTransaction();
        try {

            $clinic = ClinicHasPackages::with('images')->find($id);
            if (!$clinic) {
                return redirect()->back()->withErrors('Klinik tidak ditemukan.');
            }

            $price = (int) preg_replace('/[^\d]/', '', $request->price);

            if(is_string($request->categories_services_id)) {
                $existingService  = CategoriesServices::where('name', $request->categories_services_id)->first();
                if(!$existingService) {
                    $newService = CategoriesServices::create(['name' => $request->categories_services_id]);
                    $request['categories_services_id'] = $newService->id;
                }
            }

            // Update data klinik setelah validasi
            $clinic->update([
                'name' => $request->input('name'),
                'categories_services_id' => $request->input('categories_services_id'),
                'clinic_id' => $request->input('clinic_id'),
                'rules' => $request->input('rules'),
                'duration_type' => $request->input('duration_type'),
                'duration' => $request->input('duration'),
                'unit_price' => $request->input('unit_price'),
                'expiry_date' => $request->input('expiry_date'),
                'description' => $request->input('description'),
                'price' => $price,
                'is_active' => $request->input('is_active'),
            ]);
            
            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                if(count($clinic->images) > 0) {
                    foreach($clinic->images as $image) {
                        Storage::delete($image->image);
                        $image->delete();
                    }
                }

                foreach ($request->file('images') as $key => $image) {
                    $imagePath = $image->store('images/clinic_package_images', 'public');
                    
                    // Set the first image as main image if no main image exists
                    $clinicId = $clinic->id ?? null; // Get the ID explicitly with null fallback
                    $isMain = ($key === 0 && $clinicId && !ClinicPackageImages::where('clinic_package_id', $clinicId)->where('main', 1)->exists()) ? 1 : 0;
                    
                    ClinicPackageImages::create([
                        'clinic_package_id' => $clinicId,
                        'image' => $imagePath,
                        'main' => $isMain
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('clinics.list')->with('success', 'Klinik berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal mengubah klinik.'])
                ->withInput();
        }

        
    }


    // Menghapus data klinik
    public function destroy($id)
    {
        $clinic = ClinicHasPackages::find($id);

        if ($clinic) {
            $clinic->delete();
            return redirect()->route('clinics.list')->with('success', 'Klinik berhasil dihapus.');
        } else {
            return redirect()->back()->withErrors('Klinik tidak ditemukan.');
        }
    }


    public function edit($id)
    {
        $clinic = ClinicHasPackages::find($id); // Ambil data klinik berdasarkan ID
        $categories = CategoriesServices::all();
        $spesialis = Specialist::all();
        $clinics = Clinic::all(); // Ambil semua klinik
        
        // Fetch existing images for this clinic package
        $clinicImages = ClinicPackageImages::where('clinic_package_id', $id)->get();

        if (!$clinic) {
            return redirect()->back()->withErrors('Klinik tidak ditemukan.');
        }

        return view('ekstranet.jasaklinik.edit-klinik', compact('clinic', 'spesialis', 'categories', 'clinics', 'clinicImages'));
    }

    public function getCategoriesByClinic(Request $request)
    {
        // Ambil semua kategori tanpa filter clinic_id
        $categories = CategoriesServices::all();


        return response()->json($categories);
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

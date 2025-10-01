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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClinicHasPackageController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $users = DB::table('users')
            ->select('users.*')
            ->where('role', 1)
            ->get();

        $cities = City::all();

        $clinics = ClinicHasPackages::with(['categoriesService', 'specialist', 'clinic'])
            ->whereHas('clinic', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = CategoriesServices::all();
        $spesialis = Specialist::all();

        return view('ekstranet.jasaklinik.list-klinik', compact('spesialis', 'users', 'clinics', 'cities', 'categories'));
    }

    public function create()
    {
        $categories = CategoriesServices::all();
        $spesialis = Specialist::all();
        $clinics = Clinic::where('user_id', Auth::id())->get();

        return view('ekstranet.jasaklinik.create-klinik', compact('spesialis', 'categories', 'clinics'));
    }

    public function store(Request $request)
    {
     

        $validator = Validator::make($request->all(), [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'categories_services_id' => 'required',
            'specialist_id' => 'required|integer|exists:specialists,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string|max:1000',
            'description' => 'required|string|max:2000',
            'duration' => 'required|integer|min:1',
            'expiry_date' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
            'duration_type' => 'required|in:jam,menit',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'images.max' => 'Maksimal 5 gambar yang dapat diupload',
            'images.*.max' => 'Ukuran gambar maksimal 5MB',
            'price.min' => 'Harga tidak boleh negatif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $price = (int) preg_replace('/[^\d]/', '', $request->price);
            $unitPrice = $request->unit_price ? (int) preg_replace('/[^\d]/', '', $request->unit_price) : 0;

            // Handle categories_services_id
            $categoriesServicesId = $request->categories_services_id;
            
            if (is_string($categoriesServicesId) && !is_numeric($categoriesServicesId)) {
                $existingService = CategoriesServices::where('name', $categoriesServicesId)->first();
                
                if (!$existingService) {
                    $newService = CategoriesServices::create(['name' => $categoriesServicesId]);
                    $categoriesServicesId = $newService->id;
                } else {
                    $categoriesServicesId = $existingService->id;
                }
            }

            $clinic = new ClinicHasPackages();
            $clinic->clinic_id = $request->clinic_id;
            $clinic->name = $request->name;
            $clinic->rules = $request->rules;
            $clinic->specialist_id = $request->specialist_id;
            $clinic->categories_services_id = $categoriesServicesId;
            $clinic->duration = $request->duration;
            $clinic->description = $request->description;
            $clinic->price = $price;
            $clinic->unit_price = $unitPrice;
            $clinic->expiry_date = $request->expiry_date;
            $clinic->is_active = $request->is_active;
            $clinic->duration_type = $request->duration_type;
            $clinic->save();

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('images/clinic_package_images', $imageName, 'public');
                    
                    $isMain = ($key === 0) ? 1 : 0;
                    
                    ClinicPackageImages::create([
                        'clinic_package_id' => $clinic->id,
                        'image' => $imagePath,
                        'main' => $isMain
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('clinics.list')
                ->with('success', 'Jasa klinik berhasil ditambahkan.');
                
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal menambahkan jasa klinik. Silakan coba lagi. Error: ' . $e->getMessage()])
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
            'delete_images.*' => 'nullable|integer|exists:clinic_package_images,id', // Validasi untuk delete images
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
            
            // Handle multiple image uploads and deletions
            // Hapus gambar yang dipilih
            if ($request->has('delete_images')) {
                $imagesToDelete = ClinicPackageImages::whereIn('id', $request->delete_images)
                    ->where('clinic_package_id', $clinic->id)
                    ->get();
                
                $mainImageDeleted = false;
                foreach ($imagesToDelete as $image) {
                    if ($image->main == 1) {
                        $mainImageDeleted = true;
                    }
                    Storage::delete($image->image);
                    $image->delete();
                }
                
                // Jika gambar utama dihapus dan masih ada gambar lain, tentukan gambar utama baru
                if ($mainImageDeleted) {
                    $remainingImage = ClinicPackageImages::where('clinic_package_id', $clinic->id)->first();
                    if ($remainingImage) {
                        $remainingImage->update(['main' => 1]);
                    }
                }
            }

            // Upload gambar baru
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $imagePath = $image->store('images/clinic_package_images', 'public');
                    
                    // Set the first image as main image if no main image exists
                    $clinicId = $clinic->id ?? null; // Get the ID explicitly with null fallback
                    $isMain = 0; // Default bukan gambar utama
                    
                    // Cek apakah sudah ada gambar utama (termasuk yang baru diupload)
                    $hasMainImage = ClinicPackageImages::where('clinic_package_id', $clinicId)
                        ->where('main', 1)
                        ->exists();
                    
                    // Jika belum ada gambar utama, set gambar pertama sebagai utama
                    if (!$hasMainImage && $key === 0) {
                        $isMain = 1;
                    }
                    
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
        $clinic = ClinicHasPackages::with('clinic')->find($id); // Ambil data klinik berdasarkan ID dengan relasi clinic
        $categories = CategoriesServices::all();
        $spesialis = Specialist::all();
        $clinics = Clinic::all(); // Ambil semua klinik
        
        // Fetch existing images for this clinic package
        $clinicImages = ClinicPackageImages::where('clinic_package_id', $id)->get();

        if (!$clinic) {
            return redirect()->back()->withErrors('Klinik tidak ditemukan.');
        }

        // Tambahkan informasi jenis bisnis
        $businessCategory = $clinic->clinic ? $clinic->clinic->category : null;

        return view('ekstranet.jasaklinik.edit-klinik', compact('clinic', 'spesialis', 'categories', 'clinics', 'clinicImages', 'businessCategory'));
    }

    public function getCategoriesByClinic(Request $request)
    {
        // Ambil semua kategori tanpa filter clinic_id
        $categories = CategoriesServices::all();
        
        // Filter kategori berdasarkan jenis bisnis jika parameter dikirim
        if ($request->has('business_category')) {
            $businessCategory = $request->input('business_category');
            
            // Tentukan kategori yang sesuai berdasarkan jenis bisnis
            switch ($businessCategory) {
                case 'kesehatan': // Health
                    // Untuk kategori Health, sertakan Clinic dan kategori lainnya
                    $allowedCategories = ['Clinic', 'Threadlift', 'Peeling', 'Injection'];
                    $categories = $categories->filter(function ($category) use ($allowedCategories) {
                        return in_array($category->name, $allowedCategories);
                    });
                    break;
                case 'kecantikan': // Beauty
                    // Untuk kategori Beauty, sertakan Service, Product dan kategori lainnya
                    $allowedCategories = ['Service', 'Product', 'Threadlift', 'Peeling', 'Injection'];
                    $categories = $categories->filter(function ($category) use ($allowedCategories) {
                        return in_array($category->name, $allowedCategories);
                    });
                    break;
                case 'spa dan kecantikan': // Spa & Beauty
                    // Untuk kategori Spa & Beauty, sertakan semua kategori
                    break;
                default:
                    // Default behavior - sertakan semua kategori
                    break;
            }
        }

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
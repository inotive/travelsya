<?php

namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
use App\Models\ClinicPackageImages;
use App\Models\Specialist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            ->whereHas('clinic', function ($query) use ($userId) {
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
        // $imageName = null;
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/clinichaspackages', $imageName);
        // }

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
        // $clinic->image = $imageName;
        // $clinic->duration_type = $request->input('duration_type');
        $clinic->save();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/clinic_package_images', 'public');
            ClinicPackageImages::create([
                'clinic_package_id' => $clinic->id,
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('clinics.list')->with('success', 'Clinic service added successfully.');
    }


    // Mengupdate data klinik
    public function update(Request $request, $id)
    {
        $clinic = ClinicHasPackages::find($id);

        if (!$clinic) {
            return redirect()->back()->withErrors('Klinik tidak ditemukan.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'categories_services_id' => 'required', // Misalnya memastikan kategori yang dipilih ada
            'clinic_id' => 'nullable', // Misalnya memastikan klinik yang dipilih ada
            'rules' => 'required|string',
            'duration_type' => 'required|in:menit,jam', // Pastikan nilai duration_type valid
            'duration' => 'nullable',
            'unit_price' => 'nullable|string',
            'expiry_date' => 'nullable|integer', // Validasi agar tanggal tidak lebih dari hari ini
            'description' => 'required|string',
            'price' => 'required', // Validasi harga minimal 0
            'is_active' => 'required',
        ]);

        // Update data klinik setelah validasi
        $clinic->update([
            'name' => $request->name,
            'categories_services_id' => $request->categories_services_id,
            'clinic_id' => $request->clinic_id,
            'rules' => $request->rules,
            'duration_type' => $request->duration_type,
            'duration' => $request->duration,
            'unit_price' => $request->unit_price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('clinics.list')->with('success', 'Klinik berhasil diperbarui.');
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

        if (!$clinic) {
            return redirect()->back()->withErrors('Klinik tidak ditemukan.');
        }

        return view('ekstranet.jasaklinik.edit-klinik', compact('clinic', 'spesialis', 'categories', 'clinics'));
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

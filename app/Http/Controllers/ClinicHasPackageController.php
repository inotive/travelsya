<?php
namespace App\Http\Controllers;

use App\Models\CategoriesServices;
use App\Models\Clinic;
use App\Models\City;
use App\Models\ClinicHasPackages;
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

}

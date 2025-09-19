<?php

namespace App\Http\Controllers\Partner;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Policy;

use App\Models\CarModel;
use App\Models\Category;
use App\Models\CarRental;
use Illuminate\Http\Request;
use App\Models\CarRentalHasCars;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        // Get all car rentals for the user
        $car_rentals = CarRental::where('user_id', $user->id)->get();
        
        \Log::info('User accessing index: ' . $user->id . ' (' . $user->name . ') with role: ' . $user->role);
        \Log::info('Car Rentals found: ' . $car_rentals->count());

        if ($car_rentals->count() > 0) {
            // Get all car rental IDs
            $car_rental_ids = $car_rentals->pluck('id')->toArray();
            
            $cars = CarRentalHasCars::with('brand', 'carModel', 'policy', 'carRental')
                ->whereIn('car_rental_id', $car_rental_ids)
                ->get();
            
            \Log::info('Cars count for car_rental_ids ' . implode(',', $car_rental_ids) . ': ' . $cars->count());
            foreach($cars as $car) {
                \Log::info('Car ID: ' . $car->id . ', Brand: ' . ($car->brand ? $car->brand->name : 'null') . ', Model: ' . ($car->carModel ? $car->carModel->name : 'null'));
            }
        } else {
            $cars = collect(); // Return empty collection if no car rental found
            \Log::info('No car rental found for user ID: ' . $user->id);
        }

        // For create form, we still need a single car_rental
        $car_rental = $car_rentals->first();

        return view('ekstranet.kendaraaan.list-kendaraan', compact('cars', 'brands', 'car_models', 'policies', 'car_rental', 'car_rentals'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $validator = Validator::make($request->all(), [
            'car_rental_id' => 'required|exists:car_rentals,id',
            'brand_id' => 'required',
            'car_model_id' => 'required',
            'category' => 'required',
            'category_rent' => 'required',
            'rental_price_per_day' => 'required',
            'pickup_location' => 'required|string|max:255',
            'description' => 'required',
            // 'policy_id' => 'nullable',
            'years' => 'required',
            'number_seats' => 'required',
            'status' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Validation has already been done above

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validasi bahwa user memiliki akses ke car_rental_id yang dipilih
        $user = auth()->user();
        $carRental = CarRental::where('user_id', $user->id)->where('id', $request->car_rental_id)->first();
        
        \Log::info('User attempting to create car: ' . $user->id . ' (' . $user->name . ')');
        \Log::info('Selected car_rental_id: ' . $request->car_rental_id);
        \Log::info('Car rental found for user: ' . ($carRental ? 'yes' : 'no'));

        if (!$carRental) {
            return redirect()->back()->withErrors(['car_rental_id' => 'Anda tidak memiliki akses ke rental mobil ini.'])->withInput();
        }

        // Proses upload gambar
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image && $image->isValid()) {
                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('cars', $imageName, 'public');
                    $imageNames[] = $imageName;
                }
            }
        }

        $price = (int) preg_replace('/[^\d]/', '', $request->rental_price_per_day);

        // Simpan data kendaraan
        $car = new CarRentalHasCars();
        $car->car_rental_id = $request->car_rental_id;
        $car->brand_id = $request->brand_id;
        $car->car_model_id = $request->car_model_id;
        $car->category = $request->category;
        $car->category_rent = $request->category_rent;
        $car->rental_price_per_day = $price;
        $car->pickup_location = $request->pickup_location;
        $car->description = $request->description;
        // $car->policy_id = $request->policy_id;
        $car->years = $request->years;
        $car->number_seats = $request->number_seats;
        $car->status = $request->status;
        // Gambar utama adalah gambar pertama
        $car->image_url = !empty($imageNames) ? $imageNames[0] : null;
        $car->save();
        
        // Logging untuk debugging
        \Log::info('Car created with ID: ' . $car->id);
        \Log::info('Car rental ID: ' . $car->car_rental_id);
        \Log::info('User ID: ' . $user->id);

        return redirect()->route('partner.daftar.kendaraan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(Request $request, $id)
    {
        $car = CarRentalHasCars::find($id);
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();
        // dd($car_models);
        $car_rentals = CarRental::all();

        return view('ekstranet.kendaraaan.update', compact('car', 'brands', 'policies', 'car_models', 'car_rentals', 'id'));
    }

    public function update(Request $request, $id)
    {
        $car = CarRentalHasCars::find($id);
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        $validator = Validator::make($request->all(), [
            'car_rental_id' => 'required|exists:car_rentals,id',
            'brand_id' => 'required',
            'car_model_id' => 'required',
            'category' => 'required',
            'category_rent' => 'required',
            'rental_price_per_day' => 'required',
            'pickup_location' => 'required|string|max:255',
            'description' => 'required',
            // 'policy_id' => 'nullable',
            'years' => 'required',
            'number_seats' => 'required',
            'status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validasi bahwa user memiliki akses ke car_rental_id yang dipilih
        $user = auth()->user();
        $carRental = CarRental::where('user_id', $user->id)->where('id', $request->car_rental_id)->first();
        
        if (!$carRental) {
            return redirect()->back()->withErrors(['car_rental_id' => 'Anda tidak memiliki akses ke rental mobil ini.'])->withInput();
        }

        // Proses upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image && $image->isValid()) {
                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('cars', $imageName, 'public');
                    // Gambar pertama akan menjadi gambar utama
                    if ($index == 0) {
                        // Hapus gambar lama jika ada
                        if($car->image_url) Storage::disk('public')->delete('cars/' . $car->image_url);
                        $car->image_url = $imageName;
                    }
                }
            }
        }

        $car->car_rental_id = $request->car_rental_id;
        $car->brand_id = $request->brand_id;
        $car->car_model_id = $request->car_model_id;
        $car->category = $request->category;
        $car->category_rent = $request->category_rent;
        $car->rental_price_per_day = $request->rental_price_per_day;
        $car->pickup_location = $request->pickup_location;
        $car->description = $request->description;
        // $car->policy_id = $request->policy_id;
        $car->years = $request->years;
        $car->number_seats = $request->number_seats;
        $car->status = $request->status;
        $car->save();

        return redirect()->route('partner.daftar.kendaraan')->with('update', 'Data berhasil diupdate!');
    }

    public function halamanCreate()
    {
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();
        $car_rentals = CarRental::where('user_id', auth()->user()->id)->get();

        return view('ekstranet.kendaraaan.create', compact('brands', 'policies', 'car_models', 'car_rentals'));
    }

    public function halamanUpdate()
    {
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();
        $car_rentals = CarRental::all();

        return view('ekstranet.kendaraaan.update', compact('brands', 'policies', 'car_models', 'car_rentals'));
    }

    public function destroy($id)
    {
        $car = CarRentalHasCars::findOrFail($id);
        $car->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }

    public function getCarModels(Request $request)
    {
        $models = CarModel::where('brand_id', $request->brand_id)->get();

        return response()->json([
            'models' => $models
        ]);
    }
}

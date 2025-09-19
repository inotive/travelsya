<?php

namespace App\Http\Controllers\Partner;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Policy;
use App\Models\CarImage;
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

        $car_rentals = CarRental::where('user_id', $user->id)->get();

        if ($car_rentals->count() > 0) {
            $car_rental_ids = $car_rentals->pluck('id')->toArray();
            
            $cars = CarRentalHasCars::with(['brand', 'carModel', 'images'])
                ->whereIn('car_rental_id', $car_rental_ids)
                ->get();
        } else {
            $cars = collect();
        }

        return view('ekstranet.kendaraaan.list-kendaraan', compact('cars', 'car_rentals'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_rental_id' => 'required|exists:car_rentals,id',
            'brand_id' => 'required|exists:brands,id',
            'car_model_id' => 'required|exists:car_models,id',
            'category' => 'required|string',
            'category_rent' => 'required|string',
            'rental_price_per_day' => 'required|numeric',
            'pickup_location' => 'required|string|max:255',
            'description' => 'required|string',
            'years' => 'required|digits:4',
            'number_seats' => 'required|integer',
            'status' => 'required|boolean',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $carRental = CarRental::where('user_id', auth()->id())->where('id', $request->car_rental_id)->firstOrFail();

        $mainImagePath = null;

        try {
            DB::transaction(function () use ($request, $carRental, &$mainImagePath) {
                $car = new CarRentalHasCars();
                $car->fill($request->except(['main_image', 'additional_images']));
                $car->car_rental_id = $carRental->id;
                $car->save();

                if ($request->hasFile('main_image')) {
                    $image = $request->file('main_image');
                    $imageName = time() . '_main.' . $image->getClientOriginalExtension();
                    $mainImagePath = $image->storeAs('cars', $imageName, 'public');

                    $car->images()->create([
                        'image_url' => $mainImagePath,
                        'main' => 1,
                    ]);
                }

                if ($request->hasFile('additional_images')) {
                    foreach ($request->file('additional_images') as $image) {
                        if ($image && $image->isValid()) {
                            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                            $path = $image->storeAs('cars', $imageName, 'public');
                            $car->images()->create([
                                'image_url' => $path,
                                'main' => 0,
                            ]);
                        }
                    }
                }
                
                if ($mainImagePath) {
                    $car->image_url = $mainImagePath;
                    $car->save();
                }
            });
        } catch (\Exception $e) {
            
            \Log::error('Error creating car: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data kendaraan. Silakan coba lagi.')->withInput();
        }

        return redirect()->route('partner.daftar.kendaraan')->with('success_add', 'Data berhasil ditambahkan!');
    }

    public function show(Request $request, $id)
    {
        $car = CarRentalHasCars::with('images')->findOrFail($id);
        
        $user = auth()->user();
        $carRental = CarRental::where('user_id', $user->id)->where('id', $car->car_rental_id)->firstOrFail();

        $brands = Brand::all();
        $car_models = CarModel::where('brand_id', $car->brand_id)->get();
        $car_rentals = CarRental::where('user_id', $user->id)->get();

        return view('ekstranet.kendaraaan.update', compact('car', 'brands', 'car_models', 'car_rentals'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'car_rental_id' => 'required|exists:car_rentals,id',
            'brand_id' => 'required|exists:brands,id',
            'car_model_id' => 'required|exists:car_models,id',
            'category' => 'required|string',
            'category_rent' => 'required|string',
            'rental_price_per_day' => 'required|numeric',
            'pickup_location' => 'required|string|max:255',
            'description' => 'required|string',
            'years' => 'required|digits:4',
            'number_seats' => 'required|integer',
            'status' => 'required|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deleted_images.*' => 'nullable|integer|exists:car_images,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $car = CarRentalHasCars::with('images')->findOrFail($id);
        $carRental = CarRental::where('user_id', auth()->id())->where('id', $request->car_rental_id)->firstOrFail();

        try {
            DB::transaction(function () use ($request, $car) {
                $car->fill($request->except(['main_image', 'additional_images', 'deleted_images']));
                $car->save();

                if ($request->has('deleted_images')) {
                    $imagesToDelete = CarImage::whereIn('id', $request->deleted_images)->get();
                    foreach ($imagesToDelete as $image) {
                        Storage::disk('public')->delete($image->image_url);
                        $image->delete();
                    }
                }

                if ($request->hasFile('main_image')) {
                    $oldMainImages = $car->images()->where('main', 1)->get();
                    foreach ($oldMainImages as $oldMain) {
                        Storage::disk('public')->delete($oldMain->image_url);
                        $oldMain->delete();
                    }

                    $image = $request->file('main_image');
                    $imageName = time() . '_main.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('cars', $imageName, 'public');

                    $car->images()->create([
                        'image_url' => $path,
                        'main' => 1,
                    ]);
                    
                    $car->image_url = $path;
                    $car->save();
                }

                if ($request->hasFile('additional_images')) {
                    foreach ($request->file('additional_images') as $image) {
                        if ($image && $image->isValid()) {
                            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                            $path = $image->storeAs('cars', $imageName, 'public');
                            $car->images()->create([
                                'image_url' => $path,
                                'main' => 0,
                            ]);
                        }
                    }
                }
            });
        } catch (\Exception $e) {
            \Log::error('Error updating car: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data kendaraan. Silakan coba lagi.')->withInput();
        }

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
        $car = CarRentalHasCars::with('images')->findOrFail($id);
        $carRental = CarRental::where('user_id', auth()->id())->where('id', $car->car_rental_id)->firstOrFail();

        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }
        
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

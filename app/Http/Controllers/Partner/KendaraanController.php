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
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();
        $car_rental = CarRental::all();

        $cars = CarRentalHasCars::with('brand', 'carModel', 'policy', 'carRental')->get();
        return view('ekstranet.kendaraaan.list-kendaraan', compact('cars', 'brands', 'car_models', 'policies', 'car_rental'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();
        $cars = CarRentalHasCars::all();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'car_model_id' => 'required',
            'category' => 'required',
            'category_rent' => 'required',
            'rental_price_per_day' => 'required',
            'duration' => 'required',
            'description' => 'required',
            // 'policy_id' => 'nullable',
            'years' => 'nullable',
            'number_seats' => 'required',
            'status' => 'required',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car_rental = CarRental::find(2);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('cars', $imageName, 'public');
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'car_rental_id' => $car_rental->id,
            'brand_id' => $request->brand_id,
            'car_model_id' => $request->car_model_id,
            'category' => $request->category,
            'category_rent' => $request->category_rent,
            'rental_price_per_day' => $request->rental_price_per_day,
            'duration' => $request->duration,
            'description' => $request->description,
            // 'policy_id' => $request->policy_id,
            'years' => $request->years,
            'number_seats' => $request->number_seats,
            'status' => $request->status,
            'image_url' => $imageName,
        ];

        DB::table('car_rental_has_cars')->insert($data);

        return redirect()->route('partner.daftar.kendaraan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(Request $request, $id)
    {
        $car = CarRentalHasCars::find($id);
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        return view('ekstranet.kendaraaan.update', compact('car', 'brands', 'policies', 'car_models', 'id'));
    }

    public function update(Request $request, $id)
    {
        $car = CarRentalHasCars::find($id);
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'car_model_id' => 'required',
            'category' => 'required',
            'category_rent' => 'required',
            'rental_price_per_day' => 'required',
            'duration' => 'required',
            'description' => 'required',
            // 'policy_id' => 'nullable',
            'years' => 'nullable',
            'number_seats' => 'required',
            'status' => 'required',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('cars', $imageName, 'public');
        } else {
            $imageName = $car->image_url;
        }

        $car->brand_id = $request->brand_id;
        $car->car_model_id = $request->car_model_id;
        $car->category = $request->category;
        $car->category_rent = $request->category_rent;
        $car->rental_price_per_day = $request->rental_price_per_day;
        $car->duration = $request->duration;
        $car->description = $request->description;
        // $car->policy_id = $request->policy_id;
        $car->years = $request->years;
        $car->number_seats = $request->number_seats;
        $car->status = $request->status;
        $car->image_url = $imageName;
        $car->save();

        return redirect()->route('partner.daftar.kendaraan')->with('update', 'Data berhasil diupdate!');
    }

    public function halamanCreate()
    {
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        return view('ekstranet.kendaraaan.create', compact('brands', 'policies', 'car_models'));
    }

    public function halamanUpdate()
    {
        $brands = Brand::all();
        $policies = Policy::all();
        $car_models = CarModel::all();

        return view('ekstranet.kendaraaan.update', compact('brands', 'policies', 'car_models'));
    }

    public function destroy($id)
    {
        $car = CarRentalHasCars::findOrFail($id);
        $car->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }

}

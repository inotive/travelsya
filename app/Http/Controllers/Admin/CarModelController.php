<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    use UploadFile;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carModels = CarModel::with('brand')->orderBy('created_at', 'desc')->paginate(10);

        $brands = Brand::orderBy('name', 'asc')->get();
        // Ubah: brands = daftar merek, carModels = daftar tipe
        return view('admin.management-car-model.index', [
            'carModels' => $carModels, // carModels = tipe
            'brands' => $brands,       // brands = merek
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        // brands = merek
        return view('admin.management-car-model.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id', // brand_id = merek_id
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name, // name = nama tipe
            'brand_id' => $request->brand_id, // brand_id = merek_id
        ];

        if ($request->hasFile('image')) {
            $image = $this->storeFile($request->file('image'), 'car-models');
            $data['image'] = "car-models/" . $image;
        }

        CarModel::create($data);

        // Ubah istilah: "Merek kendaraan berhasil ditambahkan" => "Tipe kendaraan berhasil ditambahkan"
        return redirect()->route('admin.car-model.index')->with('success', 'Tipe kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        $carModel->load('brand');
        return view('admin.management-car-model.show', compact('carModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarModel $carModel)
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        // brands = merek
        return view('admin.management-car-model.edit', compact('carModel', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id', // brand_id = merek_id
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name, // name = nama tipe
            'brand_id' => $request->brand_id, // brand_id = merek_id
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($carModel->image) {
                $this->deleteFile($carModel->image, 'car-models');
            }
            $image = $this->storeFile($request->file('image'), 'car-models');
            $data['image'] = "car-models/" . $image;
        }

        $carModel->update($data);

        // Ubah istilah: "Merek kendaraan berhasil diperbarui" => "Tipe kendaraan berhasil diperbarui"
        return redirect()->route('admin.car-model.index')->with('success', 'Tipe kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        // Check if car model is being used
        if ($carModel->vendor()->count() > 0) {
            // Ubah istilah: "Merek kendaraan tidak dapat dihapus karena masih digunakan" => "Tipe kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Tipe kendaraan tidak dapat dihapus karena masih digunakan');
        }

        if ($carModel->carRentalHasCars()->count() > 0) {
            // Ubah istilah: "Merek kendaraan tidak dapat dihapus karena masih digunakan" => "Tipe kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Tipe kendaraan tidak dapat dihapus karena masih digunakan');
        }

        // Delete image if exists
        if ($carModel->image) {
            $this->deleteFile($carModel->image, 'car-models');
        }

        $carModel->delete();

        // Ubah istilah: "Merek kendaraan berhasil dihapus" => "Tipe kendaraan berhasil dihapus"
        return redirect()->route('admin.car-model.index')->with('success', 'Tipe kendaraan berhasil dihapus');
    }
}

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
        return view('admin.management-car-model.index', compact('carModels', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin.management-car-model.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'brand_id' => $request->brand_id,
        ];

        if ($request->hasFile('image')) {
            $image = $this->storeFile($request->file('image'), 'car-models');
            $data['image'] = "car-models/" . $image;
        }

        CarModel::create($data);

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
        return view('admin.management-car-model.edit', compact('carModel', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'brand_id' => $request->brand_id,
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

        return redirect()->route('admin.car-model.index')->with('success', 'Tipe kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        // Check if car model is being used
        if ($carModel->vendor()->count() > 0) {
            return redirect()->back()->with('error', 'Tipe kendaraan tidak dapat dihapus karena masih digunakan');
        }

        // Delete image if exists
        if ($carModel->image) {
            $this->deleteFile($carModel->image, 'car-models');
        }

        $carModel->delete();

        return redirect()->route('admin.car-model.index')->with('success', 'Tipe kendaraan berhasil dihapus');
    }
}

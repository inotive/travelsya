<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use UploadFile;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->paginate(10);
        // Ubah istilah: brands = daftar tipe
        return view('admin.management-brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ubah istilah: form tambah tipe
        return view('admin.management-brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:brands,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('image')) {
            $image = $this->storeFile($request->file('image'), 'brands');
            $data['image'] = "brands/" . $image;
        }

        Brand::create($data);

        // Ubah istilah: "Brand berhasil ditambahkan" => "Tipe kendaraan berhasil ditambahkan"
        return redirect()->route('admin.brand.index')->with('success', 'Tipe kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        // Ubah istilah: detail tipe
        return view('admin.management-brand.show', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:brands,name,' . $brand->id,
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->image) {
                $this->deleteFile($brand->image, 'brands');
            }
            $image = $this->storeFile($request->file('image'), 'brands');
            $data['image'] = "brands/" . $image;
        } else {
            // Keep existing image if no new image uploaded
            $data['image'] = $brand->image;
        }

        $brand->update($data);

        // Ubah istilah: "Brand berhasil diperbarui" => "Tipe kendaraan berhasil diperbarui"
        return redirect()->route('admin.brand.index')->with('success', 'Tipe kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Check if brand is being used
        if ($brand->vendor()->count() > 0) {
            // Ubah istilah: "Brand tidak dapat dihapus karena masih digunakan" => "Tipe kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Tipe kendaraan tidak dapat dihapus karena masih digunakan');
        }

        if ($brand->carModels()->count() > 0) {
            // Ubah istilah: "Brand tidak dapat dihapus karena masih digunakan" => "Tipe kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Tipe kendaraan tidak dapat dihapus karena masih digunakan');
        }

        // Delete image if exists
        if ($brand->image) {
            $this->deleteFile($brand->image, 'brands');
        }

        $brand->delete();

        // Ubah istilah: "Brand berhasil dihapus" => "Tipe kendaraan berhasil dihapus"
        return redirect()->route('admin.brand.index')->with('success', 'Tipe kendaraan berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
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
        // Ubah istilah: brands = daftar merek
        return view('admin.management-brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ubah istilah: form tambah merek
        return view('admin.management-brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
            ];

            if ($request->hasFile('image')) {
                $image = $this->storeFile($request->file('image'), 'brands');
                $data['image'] = "brands/" . $image;
            }

            $brand = Brand::create($data);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Merek kendaraan berhasil ditambahkan',
                    'data' => [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'image' => $brand->image
                    ]
                ]);
            }

            // Ubah istilah: "Brand berhasil ditambahkan" => "Merek kendaraan berhasil ditambahkan"
            return redirect()->route('admin.brand.index')->with('success', 'Merek kendaraan berhasil ditambahkan');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ubah istilah: detail merek
        $brand = Brand::findOrFail($id);
        dd($brand);
        return view('admin.management-brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        // Return only the form content for AJAX modal
        return view('admin.management-brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            $data = $request->validated();

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

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Merek kendaraan berhasil diperbarui',
                    'data' => [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'image' => $brand->image
                    ]
                ]);
            }

            // Ubah istilah: "Brand berhasil diperbarui" => "Merek kendaraan berhasil diperbarui"
            return redirect()->route('admin.brand.index')->with('success', 'Merek kendaraan berhasil diperbarui');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Check if brand is being used
        if ($brand->vendor()->count() > 0) {
            // Ubah istilah: "Brand tidak dapat dihapus karena masih digunakan" => "Merek kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Merek kendaraan tidak dapat dihapus karena masih digunakan');
        }

        if ($brand->carModels()->count() > 0) {
            // Ubah istilah: "Brand tidak dapat dihapus karena masih digunakan" => "Merek kendaraan tidak dapat dihapus karena masih digunakan"
            return redirect()->back()->with('error', 'Merek kendaraan tidak dapat dihapus karena masih digunakan');
        }

        // Delete image if exists
        if ($brand->image) {
            $this->deleteFile($brand->image, 'brands');
        }

        $brand->delete();

        // Ubah istilah: "Brand berhasil dihapus" => "Merek kendaraan berhasil dihapus"
        return redirect()->route('admin.brand.index')->with('success', 'Merek kendaraan berhasil dihapus');
    }
}

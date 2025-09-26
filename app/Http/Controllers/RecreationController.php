<?php

namespace App\Http\Controllers;

use App\Models\CategoryRecreation;
use App\Models\Recreation;
use App\Models\RecreationPackages;
use App\Models\RecreationPackagesImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\table;

class RecreationController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->location;
        $keyword = $request->keyword;
        $type = $request->type;

        $recreation_list = Recreation::with('recreationPackages')->when($keyword, function ($l) use ($keyword) {
            $l->where('business_name', 'like', '%' . $keyword . '%');
        })
            ->when($location, function ($l) use ($location) {
                $l->where('city', $location);
            })
            ->when($type, function ($l) use ($type) {
                $l->whereHas('category', function ($q) use ($type) {
                    $q->where('name', $type);
                });
            })
            ->get();

        $data['recreation_list'] = $recreation_list;
        $data['type'] = $type;
        $data['type_list'] = CategoryRecreation::get()->pluck('name');

        return view('recreation.list-recreation', $data);

    }

    public function filter_recreation(Request $request)
    {
        $filter = $request->filter;
        $keyword = $request->keyword;
        $filtered = Recreation::when($filter, function ($q) use ($filter) {
            $q->whereHas('category', function ($cat) use ($filter) {
                $cat->where('name', 'like', '%' . $filter . '%');
            });
        })
            ->when($keyword, function ($k) use ($keyword) {
                $k->where('business_name', 'like', '%' . $keyword . '%');
            })
            ->get();

        $items = '';

        foreach ($filtered as $key => $fil) {
            if (count($fil['recreationPackages']) > 0) {
                $untill_price = '';
                if (count($fil['recreationPackages']) > 1) {
                    $untill_price = ' - ' . number_format($fil['recreationPackages'][count($fil['recreationPackages']) - 1]->price ?? 0);
                }
                $item = '<div class="col">
                                <a href="' . route('recreations.details', [$fil['id']]) . '">
                                    <div class="card shadow h-100">
                                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            class="card-img-top" alt="...">
                                        <div class="card-body d-flex flex-column">
                                            <h4 class="card-title text-capitalize">' . $fil['business_name'] . '</h4>
                                            <p class="card-text flex-grow-1 text-capitalize">' . ($fil['kota']['city_name'] ?? 'Deleted city') . '</p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <h4 style="color: rgb(255, 0, 0);">Rp. ' . number_format($fil['recreationPackages'][0]['price']) . $untill_price . '
                    </h4>
                                                <span class="card-text" style="color: rgb(255, 0, 0);">
                                                    <i class="fa fa-star"></i>&nbsp;(5)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        </div>';
                $items = $items . $item;
            }
        }


        $data = '<h5 class="mt-10">Menampilkan ' . $filtered->count() . ' hasil pencarian ' . $filter . '</h5>
        <div class="row row-cols-1 row-cols-md-4 g-4">' . $items . '</div>';

        return $data;
    }

    public function list(Request $request)
    {
        $category = DB::table('category_recreations')->get();

        // $data = DB::table('recreation_has_packages')
        //     ->join('recreations', 'recreation_has_packages.recreation_id', '=', 'recreations.id')  // Join ke tabel recreations
        //     ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
        //     ->where('recreations.user_id', Auth::id())
        //     ->select('recreation_has_packages.*', 'category_recreations.name as category_name', 'recreations.business_name')
        //     ->get();

        $data = RecreationPackages::with(['recreation.categoryRecreation'])
            ->whereHas('recreation', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get()
            ->map(function ($item) {
                $item->category_name = $item->recreation->categoryRecreation->name ?? null;
                $item->business_name = $item->recreation->business_name ?? null;
                return $item;
            });

        // dd($data);

        return view('ekstranet.rekreasi.daftar-rekreasi', [
            'data' => $data,
            'category' => $category
        ]);
    }

    public function show($id)
    {
        $recreation = DB::table('recreation_has_packages')
            ->join('recreations', 'recreation_has_packages.recreation_id', '=', 'recreations.id')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->where('recreation_has_packages.id', $id)
            ->where('recreations.user_id', Auth::id())
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name', 'recreations.business_name as recreation_name')
            ->first();

        if ($recreation) {
            return response()->json($recreation);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan atau Anda tidak memiliki akses.'], 404);
        }
    }

    public function detail(Request $request, $id)
    {
        $recreation = Recreation::with('recreationPackages')->find($id);
        dd($recreation);
        return view('recreation.show');
    }

    public function create()
    {
        $category = DB::table('category_recreations')->get();

        $recreations = DB::table('recreations')
            ->where('user_id', Auth::id())
            ->get();

        $data = DB::table('recreation_has_packages')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->get();

        // Get actual enum values for expiry_type
        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;
        preg_match("/^enum\('(.*)'\)$/", $enumValues, $matches);
        $expiryTypes = explode("','", str_replace("'", "", $matches[1]));

        return view('ekstranet.rekreasi.create', [
            'data' => $data,
            'category' => $category,
            'expiryTypes' => $expiryTypes,
            'recreations' => $recreations
        ]);
    }

    public function store(Request $request)
    {
        $request->merge(['is_active' => $request->input('is_active', 1)]);

        // Get the actual enum values from database
        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;
        preg_match("/^enum\('(.*)'\)$/", $enumValues, $matches);
        $allowedExpiryTypes = explode("','", str_replace("'", "", $matches[1]));

        $request->validate([
            'recreation_id' => 'required|exists:recreations,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'unit_price' => 'required|string|max:255',
            'expiry_date' => 'required|numeric',
            'expiry_type' => 'required|string|in:' . implode(',', $allowedExpiryTypes),
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ], [
            'recreation_id.required' => 'Bisnis harus dipilih.',
            'recreation_id.exists' => 'Bisnis yang dipilih tidak valid.',
            'name.required' => 'Nama paket harus diisi.',
            'rules.required' => 'Peraturan harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'duration.required' => 'Durasi harus diisi.',
            'duration.numeric' => 'Durasi harus berupa angka.',
            'unit_price.required' => 'Tipe durasi harus dipilih.',
            'expiry_date.required' => 'Masa berlaku harus diisi.',
            'expiry_date.numeric' => 'Masa berlaku harus berupa angka.',
            'expiry_type.required' => 'Tipe masa berlaku harus dipilih.',
            'expiry_type.in' => 'Tipe masa berlaku yang dipilih tidak valid.',
            'price.required' => 'Harga harus diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'is_active.required' => 'Status harus dipilih.'
        ]);

        DB::beginTransaction();

        try {

            // Find the recreation business to get the category ID
            $recreationBusiness = Recreation::find($request->input('recreation_id'));
            if (!$recreationBusiness) {
                return redirect()->back()->withErrors(['error' => 'Bisnis rekreasi yang dipilih tidak valid.'])->withInput();
            }

            $price = (int) $request->price;

            $packageData = $request->all();
            $packageData['category_recreation_id'] = $recreationBusiness->category_recreation_id;
            $packageData['price'] = $price;

            $recreation = RecreationPackages::create($packageData);

            // Handle Main Image Upload
            if ($request->hasFile('main_image')) {
                $imagePath = $request->file('main_image')->store('public/images/recreation_package_images');
                RecreationPackagesImages::create([
                    'recreation_package_id' => $recreation->id,
                    'image' => $imagePath,
                    'main' => 1
                ]);
            }

            // Handle Additional Images Upload
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    if ($image) { // Check if a file was actually uploaded
                        $imagePath = $image->store('public/images/recreation_package_images');
                        RecreationPackagesImages::create([
                            'recreation_package_id' => $recreation->id,
                            'image' => $imagePath,
                            'main' => 0
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('partner.daftar-rekreasi')
                ->with('success', 'Berhasil menambahkan rekreasi!');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Store Recreation Package Error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal menambah rekreasi! ' . $e->getMessage()])
                ->withInput();
        }
        
        return redirect()->route('partner.daftar-rekreasi')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $recreation_has_packages = RecreationPackages::with('images')
            ->findOrFail($id);

        // Get actual enum values for expiry_type
        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;
        preg_match("/^enum\('(.*)'\)$/", $enumValues, $matches);
        $expiryTypes = explode("','", $matches[1]);

        $category = DB::table('category_recreations')->get();

        $recreations = DB::table('recreations')
            ->where('user_id', Auth::id())
            ->get();
            
        return view('ekstranet.rekreasi.edit', compact('recreation_has_packages', 'category', 'expiryTypes', 'recreations'));
    }


    public function update(Request $request, $id)
    {
        // Get the actual enum values from database
        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;
        preg_match("/^enum\\(\\'(.*)\\'\\)$/", $enumValues, $matches);
        $allowedExpiryTypes = explode("','", str_replace("'", "", $matches[1]));
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'expiry_date' => 'required|numeric',
            'expiry_type' => 'required|string|in:' . implode(',', $allowedExpiryTypes),
            'unit_price' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'recreation_id' => 'required|exists:recreations,id',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'integer|exists:recreation_packages_images,id'
        ], [
            'name.required' => 'Nama paket harus diisi.',
            'rules.required' => 'Peraturan harus diisi.',
            'description.required' => 'Deskripsi harus diisi.',
            'duration.required' => 'Durasi harus diisi.',
            'duration.numeric' => 'Durasi harus berupa angka.',
            'expiry_date.required' => 'Masa berlaku harus diisi.',
            'expiry_date.numeric' => 'Masa berlaku harus berupa angka.',
            'expiry_type.required' => 'Tipe masa berlaku harus dipilih.',
            'expiry_type.in' => 'Tipe masa berlaku yang dipilih tidak valid.',
            'unit_price.required' => 'Tipe durasi harus dipilih.',
            'price.required' => 'Harga harus diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'is_active.required' => 'Status harus dipilih.',
            'recreation_id.required' => 'Bisnis harus dipilih.',
            'recreation_id.exists' => 'Bisnis yang dipilih tidak valid.'
        ]);

        DB::beginTransaction();

        try {
            $recreationPackage = RecreationPackages::findOrFail($id);

            // 1. Handle Image Deletion
            if ($request->has('deleted_images')) {
                foreach ($request->deleted_images as $imageId) {
                    $image = RecreationPackagesImages::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }
            }

            // 2. Handle Main Image Upload
            if ($request->hasFile('main_image')) {
                // Delete old main image if it exists
                $oldMainImage = $recreationPackage->images()->where('main', 1)->first();
                if ($oldMainImage) {
                    Storage::disk('public')->delete($oldMainImage->image);
                    $oldMainImage->delete();
                }

                // Store new main image
                $imagePath = $request->file('main_image')->store('public/images/recreation_package_images');
                RecreationPackagesImages::create([
                    'recreation_package_id' => $recreationPackage->id,
                    'image' => $imagePath,
                    'main' => 1
                ]);
            }

            // 3. Handle Additional Images Upload
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    if ($image) {
                        $imagePath = $image->store('public/images/recreation_package_images');
                        RecreationPackagesImages::create([
                            'recreation_package_id' => $recreationPackage->id,
                            'image' => $imagePath,
                            'main' => 0
                        ]);
                    }
                }
            }

            // 4. Update Package Details
            $validatedData['price'] = (int) $validatedData['price'];
            
            $recreationPackage->update($validatedData);

            DB::commit();
            return redirect()->route('partner.daftar-rekreasi')->with('success_update', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update Recreation Package Error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['error' => 'Gagal mengubah rekreasi! ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function reservation(Request $request)
    {

        return view('recreation.reservation');
    }

    public function payment(Request $request){

        return view('recreation.payment');
    }

    public function destroy($id) {

        DB::beginTransaction();
        try {
            $recreationPackage = RecreationPackages::with('images')->findOrFail($id);
            
            // Check if the package is related to any transactions
            $relatedTransactions = DB::table('detail_transaction_recreations')
                ->where('recreationPackage_id', $id)
                ->whereNull('deleted_at')
                ->exists();
            
            if ($relatedTransactions) {
                DB::rollBack();
                return response()->json(['error' => 'Tidak dapat menghapus paket yang masih terhubung dengan transaksi.'], 422);
            }
            
            // Check if the package is related to any ratings/reviews
            $relatedRatings = DB::table('recreation_ratings')
                ->where('recreation_packages_id', $id)
                ->exists();
            
            if ($relatedRatings) {
                DB::rollBack();
                return response()->json(['error' => 'Tidak dapat menghapus paket yang masih terhubung dengan rating atau ulasan.'], 422);
            }
        
            if(count($recreationPackage->images) > 0) {
                foreach($recreationPackage->images as $image) {
                    Storage::delete($image->image);
                    $image->delete();
                }
            }
            $recreationPackage->delete();

            DB::commit();

            return response()->json(['success' => 'Recreation package deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete recreation package: ' . $e->getMessage()], 500);
        }
        

    }
}

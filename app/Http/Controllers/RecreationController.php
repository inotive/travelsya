<?php

namespace App\Http\Controllers;

use App\Models\Recreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

use function Laravel\Prompts\table;

class RecreationController extends Controller
{

    public function index(Request $request) {
        $recreation_list = DB::table('recreation_has_packages')->get();
        return view('recreation.list-recreation', ['recreation_list' => $recreation_list]);
    }

    public function list(Request $request) {
        $category = DB::table('category_recreations')->get();
        $data = DB::table('recreation_has_packages')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->get();

        return view('ekstranet.rekreasi.daftar-rekreasi', [
            'data' => $data,
            'category' => $category
        ]);
    }


    public function show($id) {
        $recreation = DB::table('recreation_has_packages')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->where('recreation_has_packages.id', $id)
            ->first();

        if ($recreation) {
            return response()->json($recreation);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category_recreation_id' => 'required|exists:category_recreations,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'ltd' => 'required|numeric',
            'expiry_date' => 'required|date',
            'unit_price' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        // Insert the new recreation package using query builder
        DB::table('recreation_has_packages')->insert([
            'recreaction_id' => 1,  // Assuming you will replace this with actual recreation ID
            'category_recreation_id' => $request->category_recreation_id,
            'name' => $request->name,
            'rules' => $request->rules,
            'description' => $request->description,
            'duration' => $request->duration,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
            'expiry_date' => $request->expiry_date,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'is_active' => $request->is_active,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Recreation package created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required',
            'category_recreation_id' => 'required',
            'duration' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        // Update data recreation
        $recreation = DB::table('recreation_has_packages')->where('id', $id)->update([
            'name' => $request->name,
            'category_recreation_id' => $request->category_recreation_id,
            'duration' => $request->duration,
            'price' => $request->price,
            'is_active' => $request->is_active,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Recreation updated successfully']);
    }

    public function reservation(Request $request) {

        return view('recreation.reservation');
    }

    // delete

    public function destroy($id) {
        // Cari data berdasarkan ID
        $recreation = DB::table('recreation_has_packages')->where('id', $id)->first();

        if ($recreation) {
            // Hapus data jika ditemukan
            DB::table('recreation_has_packages')->where('id', $id)->delete();
            return response()->json(['success' => 'Recreation package deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}



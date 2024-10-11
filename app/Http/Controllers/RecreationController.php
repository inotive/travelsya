<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


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
            ->join('recreations', 'recreation_has_packages.recreation_id', '=', 'recreations.id')  // Join ke tabel recreations
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->where('recreations.user_id', Auth::id())
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->get();

        return view('ekstranet.rekreasi.daftar-rekreasi', [
            'data' => $data,
            'category' => $category
        ]);
    }


    public function show($id) {
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

    public function create() {
        $category = DB::table('category_recreations')->get();

        $recreations = DB::table('recreations')
            ->where('user_id', Auth::id())
            ->get();

        $data = DB::table('recreation_has_packages')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->get();

        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;

        preg_match("/^enum\(\'(.*)\'\)$/", $enumValues, $matches);
        $expiryTypes = explode("','", $matches[1]);

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

        $request->validate([
            'recreation_id' => 'required|exists:recreations,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'unit_price' => 'required|string|max:255',
            'expiry' => 'required|numeric',
            'expiry_type' => 'required|string|in:Hari,Jam',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $recreationId = $request->input('recreation_id');

        $categoryRecreation = DB::table('category_recreations')
        ->where('id', $recreationId)
        ->first();

        DB::table('recreation_has_packages')->insert([
            'recreation_id' => $recreationId,
            'category_recreation_id' => $categoryRecreation->id,
            'name' => $request->name,
            'rules' => $request->rules,
            'description' => $request->description,
            'duration' => $request->duration,
            'expiry_date' => $request->expiry,
            'expiry_type' => $request->expiry_type,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'is_active' => $request->is_active,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('partner.daftar-rekreasi')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit($id) {
        $recreation_has_packages = DB::table('recreation_has_packages')->where('id', $id)->first();

        if (!$recreation_has_packages) {
            return redirect()->route('rekreasi.index')->with('error', 'Rekreasi tidak ditemukan.');
        }

        $enumValues = DB::select('SHOW COLUMNS FROM recreation_has_packages WHERE Field = "expiry_type"')[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $enumValues, $matches);
        $expiryTypes = explode("','", $matches[1]);

        $category = DB::table('category_recreations')->get();

        $recreations = DB::table('recreations')
            ->where('user_id', Auth::id())
            ->get();

        return view('ekstranet.rekreasi.edit', compact('recreation_has_packages', 'category', 'expiryTypes', 'recreations'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'expiry' => 'required|numeric',
            'expiry_type' => 'required|string|in:Hari,Jam',
            'unit_price' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'recreation_id' => 'required|exists:recreations,id',
        ]);

        $recreation = DB::table('recreations')->where('id', $request->recreation_id)->first();

        if (!$recreation) {
            return redirect()->route('partner.daftar-rekreasi')->with('error', 'Rekreasi tidak valid.');
        }

        DB::table('recreation_has_packages')->where('id', $id)->update([
            'recreation_id' => $request->recreation_id,
            'category_recreation_id' => $recreation->category_recreation_id,
            'name' => $request->name,
            'rules' => $request->rules,
            'description' => $request->description,
            'duration' => $request->duration,
            'expiry_date' => $request->expiry,
            'expiry_type' => $request->expiry_type,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'is_active' => $request->is_active,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('partner.daftar-rekreasi')->with('success_update', 'Data berhasil diperbarui.');
    }

    public function reservation(Request $request) {

        return view('recreation.reservation');
    }

    public function destroy($id) {
        $recreation = DB::table('recreation_has_packages')->where('id', $id)->first();

        if ($recreation) {
            DB::table('recreation_has_packages')->where('id', $id)->delete();
            return response()->json(['success' => 'Recreation package deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}



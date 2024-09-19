<?php

namespace App\Http\Controllers;

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
            ->paginate(10);

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

    public function create() {
        $category = DB::table('category_recreations')->get();
        $data = DB::table('recreation_has_packages')
            ->join('category_recreations', 'recreation_has_packages.category_recreation_id', '=', 'category_recreations.id')
            ->select('recreation_has_packages.*', 'category_recreations.name as category_name')
            ->get();

        return view('ekstranet.rekreasi.create', [
            'data' => $data,
            'category' => $category
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_recreation_id' => 'required|exists:category_recreations,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'ltd' => 'nullable|numeric',
            'expiry' => 'required|numeric',
            'expiryType' => 'required|string|in:Hari,Jam',
            'unit_price' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $expiry = $request->expiry;
        $expiryType = $request->expiryType;

        $daysToAdd = 0;

        if ($expiryType === 'Hari') {
            $daysToAdd = $expiry;
        } elseif ($expiryType === 'Jam') {
            $daysToAdd = intdiv($expiry, 24);
        }

        $expiryDate = Carbon::now()->addDays($daysToAdd)->toDateString();

        DB::table('recreation_has_packages')->insert([
            'recreaction_id' => 2,
            'category_recreation_id' => $request->category_recreation_id,
            'name' => $request->name,
            'rules' => $request->rules,
            'description' => $request->description,
            'duration' => $request->duration,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
            'expiry_date' => $expiryDate,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'is_active' => $request->is_active,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('partner.daftar-rekreasi')
        ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id) {
        $recreation = DB::table('recreation_has_packages')->where('id', $id)->first();

        if (!$recreation) {
            return redirect()->route('rekreasi.index')->with('error', 'Rekreasi tidak ditemukan.');
        }

        $category = DB::table('category_recreations')->get();
        return view('ekstranet.rekreasi.edit', compact('recreation', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_recreation_id' => 'required|exists:category_recreations,id',
            'name' => 'required|string|max:255',
            'rules' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'ltd' => 'nullable|numeric',
            'expiry' => 'required|numeric',
            'expiryType' => 'required|string|in:Hari,Jam',
            'unit_price' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);
        $expiry = $request->expiry;
        $expiryType = $request->expiryType;

        $daysToAdd = $expiryType === 'Hari' ? $expiry : intdiv($expiry, 24);

        $expiryDate = Carbon::now()->addDays($daysToAdd)->toDateString();

        DB::table('recreation_has_packages')->where('id', $id)->update([
            'category_recreation_id' => $request->category_recreation_id,
            'name' => $request->name,
            'rules' => $request->rules,
            'description' => $request->description,
            'duration' => $request->duration,
            'lat' => $request->lat,
            'ltd' => $request->ltd,
            'expiry_date' => $expiryDate,
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

    // delete

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



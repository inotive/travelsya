<?php

namespace App\Http\Controllers;

use App\Models\Recreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        return view('ekstranet.rekreation.daftar-rekreasi', ['data' => $data], ['category' => $category]);
    }



    public function show(string $id) {
        $recreation_list = DB::table('recreation_has_packages')->where('recreation_id', $id)->get();

        return view('', ['recreation_list' => $recreation_list]);
    }


    public function reservation(Request $request) {

        return view('recreation.reservation');
    }
}



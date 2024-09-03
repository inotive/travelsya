<?php

namespace App\Http\Controllers;

use App\Models\recreation;
use Illuminate\Http\Request;

class RecreationController extends Controller
{
    public function index(Request $request) {
        return view('recreation.list-recreation');
    }

    public function list(){
        $data = recreation::all();
        return view('ekstranet.rekreation.daftar-rekreasi', compact('data'));
    }


    public function show(string $id) {
        return view('recreation.show');
    }


    public function reservation(Request $request) {

        return view('recreation.reservation');
    }
}



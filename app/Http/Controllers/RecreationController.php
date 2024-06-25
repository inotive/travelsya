<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecreationController extends Controller
{
    public function index(Request $request) {
        return view('recreation.list-recreation');
    }


    public function show(string $id) {
        return view('recreation.show');
    }


    public function reservation(Request $request) {
    
        return view('recreation.reservation');
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeautyClinicController extends Controller
{
    public function index(Request $request) {
        return view('clinic.list-clinic');
    }


    public function show(string $id) {
        return view('clinic.show');
    }


    public function reservation(Request $request) {
    
        return view('clinic.reservation');
    }
}

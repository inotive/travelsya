<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewHealthBeautyController extends Controller
{
    public function index()
    {
        return view('pagesv2.health_beauty.index');
    }
}

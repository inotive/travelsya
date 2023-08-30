<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Point;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::with('service')->get();
        $services = Service::all();


        return view('admin.management-point.index', compact('points', 'services'));
    }

    public function updatePoint(Request $request)
    {
        $setting = Point::find($request->id);
        $setting->update($request->all());
        toast('Point has been updated', 'success');
        return redirect()->back();
    }

    public function storePoint(Request $request)
    {
        Point::create($request->all());
        toast('Point has been created', 'success');
        return redirect()->back();
    }
}

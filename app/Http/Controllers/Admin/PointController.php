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
        $request->validate([
            'multiple' => 'required|numeric',
            'value' => 'required|numeric',
        ]);

        $setting = Point::find($request->id);

        if (!$setting) {
            return response()->json(['message' => 'Point setting not found'], 404);
        }

        $setting->update($request->all());

        toast('Point has been updated', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $setting
        ]);
    }

    public function storePoint(Request $request)
    {
        Point::create($request->all());
        toast('Point has been created', 'success');
        return redirect()->back();
    }
}

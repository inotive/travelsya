<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        $points = Settings::where('category', 'point')->paginate(10);

        return view('admin.point', compact('points'));
    }

    public function updatePoint(Request $request)
    {
        $setting = Settings::find($request->id);
        $setting->update($request->all());
        toast('Point has been updated', 'success');
        return redirect()->back();
    }

    public function storePoint(Request $request)
    {
        Settings::create($request->all());
        toast('Point has been created', 'success');
        return redirect()->back();
    }
}

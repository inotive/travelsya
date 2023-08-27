<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Service;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('service')->get();
        $services = Service::all();

        return view('admin.management-fee.index', compact('fees', 'services'));
    }

    public function updateFee(Request $request)
    {
        $setting = Fee::find($request->id);
        $setting->update($request->all());
        toast('Fee admin has been updated', 'success');
        return redirect()->back();
    }

    public function storeFee(Request $request)
    {
        Fee::create($request->all());
        toast('Fee admin has been created', 'success');
        return redirect()->back();
    }
}

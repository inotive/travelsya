<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Setting::where('category', 'fee')->paginate(10);

        return view('admin.fee', compact('fees'));
    }

    public function updateFee(Request $request)
    {
        $setting = Setting::find($request->id);
        $setting->update($request->all());
        toast('Fee admin has been updated', 'success');
        return redirect()->back();
    }

    public function storeFee(Request $request)
    {
        Setting::create($request->all());
        toast('Fee admin has been created', 'success');
        return redirect()->back();
    }
}

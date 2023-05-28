<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Settings::where('category', 'fee')->paginate(10);

        return view('admin.fee', compact('fees'));
    }

    public function updateFee(Request $request)
    {
        $setting = Settings::find($request->id);
        $setting->update($request->all());
        toast('Fee admin has been updated', 'success');
        return redirect()->back();
    }

    public function storeFee(Request $request)
    {
        Settings::create($request->all());
        toast('Fee admin has been created', 'success');
        return redirect()->back();
    }
}

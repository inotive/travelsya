<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('service')->get();
        $services = Service::all();

        return view('admin.management-fee.index', compact('fees', 'services'));
    }

    public function show($id)
    {
        $fee = Fee::findorFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $fee
        ]);
    }

    public function updateFee(Request $request, $id)
    {
        $setting = Fee::find($id);
        
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'percent' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            toast($errorMessages, 'error');
            return redirect()->back();
        }

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

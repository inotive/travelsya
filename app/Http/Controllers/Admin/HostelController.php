<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelImage;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::with('hostelRoom')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.hostel', compact('hostels'));
    }

    public function show($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->where('user_id', auth()->user()->id)->find($id);


        return view('admin.hostel-show', compact('hostel'));
    }

    public function mainImage(Request $request)
    {
        $hostel = HostelImage::where('hostel_id', $request->hostelid)->where('main', 1)->update(['main' => 0]);
        $image = HostelImage::find($request->id)->update(['main' => 1]);

        toast('Image has been updated', 'success');
        return redirect()->back();
    }
}

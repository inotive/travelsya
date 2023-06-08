<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelImage;
use App\Models\HostelRoom;
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
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('admin.hostel-show', compact('hostel'));
    }

    public function mainImage(Request $request)
    {
        $hostel = HostelImage::where('hostel_id', $request->hostelid)->where('main', 1)->update(['main' => 0]);
        $image = HostelImage::find($request->id)->update(['main' => 1]);

        toast('Image has been updated', 'success');
        return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        HostelImage::find($request->id)->delete();
        toast('Image has been deleted', 'warning');
        return redirect()->back();
    }

    public function edit($id)
    {
        $hostel = Hostel::with('hostelRoom', 'hostelImage')->find($id);

        return view('admin.hostel-edit', compact('hostel'));
    }

    public function update(Request $reqeust, $id)
    {
        $hostel = Hostel::find($id)->update($reqeust->all());

        toast('Hostel has been updated', 'success');
        return redirect()->back();
    }
}

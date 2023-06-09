<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\HostelImage;
use App\Models\HostelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function update(Request $request, $id)
    {
        $hostel = Hostel::find($id)->update($request->all());

        toast('Hostel has been updated', 'success');
        return redirect()->back();
    }

    public function showImage($id)
    {
        $hostel = Hostel::with('hostelImage')->find($id);

        return view('admin.hostel-image', compact('hostel'));
    }

    public function storeImage(Request $request)
    {
        $request->validate([
            "id" => "required",
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $hostel = Hostel::find($request->id);
        for ($i = 0; $i < count($request->image); $i++) {
            $request->file('image')[$i]->storeAs(
                'hostel/' . Str::slug($hostel->name, '-'),
                Str::slug($hostel->name) . '-' . time() . '.' . $request->file('image')[$i]->getClientOriginalExtension(),
                'public',
            );
            HostelImage::create([
                'hostel_id' => $request->id,
                'image' => Str::slug($hostel->name) . '/' . Str::slug($hostel->name) . '-' . time() . '.' . $request->file('image')[$i]->getClientOriginalExtension(),
                'main' => 0
            ]);
        }
        toast('Hostel has been updated', 'success');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Recreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementRecreationController extends Controller
{
    public function semuaRekreasi()
    {
        $recreations = Recreation::where('user_id', Auth::id())->get();
        return view('ekstranet.rekreasi.semua-rekreasi', compact('recreations'));
    }

    public function profilRekreasi($id)
    {
        $recreation = Recreation::findOrFail($id);
        $cities = \App\Models\City::all();
        $categories = \App\Models\CategoryRecreation::all();
        return view('ekstranet.rekreasi.profil-rekreasi', compact('recreation', 'cities', 'categories'));
    }

    public function updateProfilRekreasi(Request $request, $id)
    {
        $recreation = Recreation::findOrFail($id);
        $recreation->update($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete old main image if it exists
            $oldMainImage = $recreation->image;
            if ($oldMainImage) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldMainImage->image);
                $oldMainImage->delete();
            }

            // Store new main image
            $imagePath = $request->file('image')->store('images/recreations', 'public');

            // Create new image record
            \App\Models\recreationImages::create([
                'recreation_id' => $recreation->id,
                'image' => $imagePath,
                'main' => 1
            ]);
        }

        return redirect()->route('partner.recreation.all')->with('success', 'Profil rekreasi berhasil diperbarui.');
    }
}

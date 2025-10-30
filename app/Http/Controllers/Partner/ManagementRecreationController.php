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
        return view('ekstranet.rekreasi.profil-rekreasi', compact('recreation'));
    }

    public function updateProfilRekreasi(Request $request, $id)
    {
        $recreation = Recreation::findOrFail($id);
        $recreation->update($request->all());

        return redirect()->route('partner.recreation.all')->with('success', 'Profil rekreasi berhasil diperbarui.');
    }
}

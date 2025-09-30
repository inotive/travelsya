<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BusFacility;
use App\Models\BusTravelHasBus;
use App\Models\BusTravelHasFacility;
use App\Models\BusTravels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusTravelController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $bus_travel_ids = BusTravels::where('user_id', $user->id)->pluck('id');
        $bus_travel = BusTravels::whereIn('id', $bus_travel_ids)->orderBy('id', 'desc')->get();

        $buses = BusTravelHasBus::with(['busTravel', 'facilities.facility'])
            ->whereIn('bus_travel_id', $bus_travel_ids)
            ->orderBy('id', 'desc')
            ->get();

        return view('ekstranet.bus-travel.list-bus-travel', [
            'buses'       => $buses,
            'bus_travel'  => $bus_travel,
        ]);
    }

    public function create()
    {
        $bus_travel = BusTravels::where('user_id', auth()->user()->id)->get();
        $facilities = BusFacility::all();

        return view('ekstranet.bus-travel.create-bus-travel', [
            'bus_travel' => $bus_travel,
            'facilities' => $facilities
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_travel_id' => 'required|exists:bus_travels,id',
            'name'          => 'required',
            'deskripsi'     => 'required|string',
            'kategori'      => 'required|string',
            'tos'           => 'required|string',
            'class'         => 'required',
            'is_active'     => 'required',
            'number_seats'  => 'required|integer',
            'images'        => 'nullable|array',
            'images.*'      => 'image|mimes:jpg,jpeg,png|max:2048',
            'facilities'    => 'nullable|array',
            'facilities.*'  => 'exists:bus_facilities,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = auth()->user();
        $bus_travel_id = $request->bus_travel_id;

        $bus_travel = BusTravels::where('id', $bus_travel_id)->first();
        if (!$bus_travel) {
            return redirect()->route('partner.daftar.bus-travel')->with('error', 'Bus & Travel tidak ditemukan!');
        }

        if ($bus_travel->user_id != $user->id) {
            return redirect()->route('partner.daftar.bus-travel')->with('error', 'Bus & Travel ini bukan milik Anda!');
        }

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('buses', $imageName, 'public');
                $imageNames[] = $imageName;
            }
        }

        $data = [
            'bus_travel_id' => $bus_travel_id,
            'name'          => $request->name,
            'deskripsi'     => $request->deskripsi,
            'kategori'      => $request->kategori,
            'tos'           => $request->tos,
            'class'         => $request->class,
            'is_active'     => $request->is_active,
            'number_seats'  => $request->number_seats,
            'image'         => json_encode($imageNames),
        ];

        $bus_has_travel = DB::table('bus_travel_has_buses')->insertGetId($data);

        if ($request->has('facilities')) {
            foreach ($request->facilities as $facility) {
                BusTravelHasFacility::create([
                    'bus_travel_has_bus_id' => $bus_has_travel,
                    'bus_facility_id'       => $facility
                ]);
            }
        }

        return redirect()->route('partner.daftar.bus-travel')->with('status', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $bus = BusTravelHasBus::with(['busTravel', 'facilities.facility'])
            ->where('id', $id)
            ->first();

        $bus_travel = BusTravels::where('user_id', auth()->user()->id)->get();
        $facilities = BusFacility::all();
        $selectedFacilities = $bus->facilities->pluck('bus_facility_id')->toArray();

        return view('ekstranet.bus-travel.update', [
            'bus'                => $bus,
            'bus_travel'         => $bus_travel,
            'facilities'         => $facilities,
            'selectedFacilities' => $selectedFacilities
        ]);
    }

    public function update(Request $request, $id)
    {
        $bus = BusTravelHasBus::find($id);

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'deskripsi'    => 'required|string',
            'kategori'     => 'required|string',
            'tos'          => 'required|string',
            'class'        => 'required',
            'is_active'    => 'required',
            'number_seats' => 'required|integer',
            'images'       => 'nullable|array',
            'images.*'     => 'image|mimes:jpg,jpeg,png|max:2048',
            'facilities'   => 'nullable|array',
            'facilities.*' => 'exists:bus_facilities,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imageNames = is_array($bus->image) ? $bus->image : json_decode($bus->image, true) ?? [];

        if ($request->filled('removed_images')) {
            $removedImages = json_decode($request->removed_images, true) ?? [];
            foreach ($removedImages as $removed) {
                Storage::disk('public')->delete('buses/' . $removed);
                $imageNames = array_values(array_diff($imageNames, [$removed]));
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('buses', $imageName, 'public');
                $imageNames[] = $imageName;
            }
        }

        $bus->name         = $request->name;
        $bus->deskripsi    = $request->deskripsi;
        $bus->kategori     = $request->kategori;
        $bus->tos          = $request->tos;
        $bus->class        = $request->class;
        $bus->is_active    = $request->is_active;
        $bus->number_seats = $request->number_seats;
        $bus->image        = json_encode($imageNames);
        $bus->save();

        if ($request->has('facilities')) {
            BusTravelHasFacility::where('bus_travel_has_bus_id', $id)->delete();
            foreach ($request->facilities as $facility) {
                BusTravelHasFacility::create([
                    'bus_travel_has_bus_id' => $id,
                    'bus_facility_id'       => $facility
                ]);
            }
        }

        return redirect()->route('partner.daftar.bus-travel')->with('update', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $bus = BusTravelHasBus::find($id);

        $images = is_array($bus->image) ? $bus->image : json_decode($bus->image, true);
        if (!empty($images) && is_array($images)) {
            foreach ($images as $image) {
                Storage::disk('public')->delete('buses/' . $image);
            }
        }

        $bus->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }
}

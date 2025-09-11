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

        // Get ALL bus_travel_ids for this user
        $bus_travel_ids = BusTravels::where('user_id', $user->id)->pluck('id');

        // Get all bus travels for this user (used in view)
        $bus_travel = BusTravels::whereIn('id', $bus_travel_ids)->latest()->get();

        // Get all buses for ALL of the user's bus travels
        $buses = BusTravelHasBus::with(['busTravel', 'facilities.facility'])
            ->whereIn('bus_travel_id', $bus_travel_ids)
            ->latest()
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

        $view = [
            'bus_travel' => $bus_travel,
            'facilities' => $facilities
        ];

        return view('ekstranet.bus-travel.create-bus-travel', $view);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_travel_id' => 'required|exists:bus_travels,id',
            'name' => 'required',
            'tos' => 'required|string',
            'class' => 'required',
            'is_active' => 'required',
            'number_seats' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:bus_facilities,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = auth()->user();
        $bus_travel_id = $request->input('bus_travel_id');

        // Check if the bus travel exists
        $bus_travel = BusTravels::where('id', $bus_travel_id)->first();
        if (!$bus_travel) {
            return redirect()->route('partner.daftar.bus-travel')->with('error', 'Bus & Travel tidak ditemukan!');
        }

        // Check if the bus travel belongs to the current user
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
            'bus_travel_id' => $request->input('bus_travel_id'),
            'name' => $request->input('name'),
            'tos' => $request->input('tos'),
            'class' => $request->input('class'),
            'is_active' => $request->input('is_active'),
            'number_seats' => $request->input('number_seats'),
            'image' => json_encode($imageNames),
        ];

        Log::info($request->all());

        $bus_has_travel = DB::table('bus_travel_has_buses')->insertGetId($data);

        if ($request->has('facilities')) {
            foreach ($request->facilities as $facility) {
                BusTravelHasFacility::create([
                    'bus_travel_has_bus_id' => $bus_has_travel,
                    'bus_facility_id' => $facility
                ]);
            }
        }

        return redirect()->route('partner.daftar.bus-travel')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $bus = BusTravelHasBus::with(['busTravel', 'facilities.facility'])
            ->where('id', $id)
            ->first();
        $bus_travel = BusTravels::where('user_id', auth()->user()->id)->get();
        $facilities = BusFacility::all();

        $view = [
            'bus' => $bus,
            'bus_travel' =>  $bus_travel,
            'facilities' => $facilities
        ];

        return view('ekstranet.bus-travel.update', $view);
    }

    public function update(Request $request, $id)
    {
        $bus = BusTravelHasBus::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tos' => 'required|string',
            'class' => 'required',
            'is_active' => 'required',
            'number_seats' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:bus_facilities,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imageNames = json_decode($bus->image, true) ?? [];

        if ($request->hasFile('images')) {
            // Optional: delete old images if you want fresh ones
            foreach ($imageNames as $old) {
                Storage::disk('public')->delete('buses/' . $old);
            }
            $imageNames = []; // reset

            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('buses', $imageName, 'public');
                $imageNames[] = $imageName;
            }
        }

        $bus->name = $request->name;
        $bus->tos = $request->tos;
        $bus->class = $request->class;
        $bus->is_active = $request->is_active;
        $bus->number_seats = $request->number_seats;
        $bus->image = json_encode($imageNames);
        $bus->save();

        if ($request->has('facilities')) {
            BusTravelHasFacility::where('bus_travel_has_bus_id', $id)->delete();
            foreach ($request->facilities as $facility) {
                BusTravelHasFacility::create([
                    'bus_travel_has_bus_id' => $id,
                    'bus_facility_id' => $facility
                ]);
            }
        }

        return redirect()->route('partner.daftar.bus-travel')->with('update', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $bus = BusTravelHasBus::find($id);

        $images = json_decode($bus->image, true);
        if (!empty($images)) {
            foreach ($images as $image) {
                Storage::disk('public')->delete('buses/' . $image);
            }
        }

        $bus->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }
}

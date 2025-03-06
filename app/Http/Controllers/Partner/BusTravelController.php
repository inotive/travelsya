<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BusTravelHasBus;
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

        $bus_travel = BusTravels::all();

        $bus_travel_id = BusTravels::where('user_id', $user->id)->pluck('id')->first();

        $buses = BusTravelHasBus::with('busTravel')
            ->where('bus_travel_id', $bus_travel_id)
            ->get();

        $view = [
            'buses' => $buses,
            'bus_travel' => $bus_travel,
        ];

        return view('ekstranet.bus-travel.list-bus-travel', $view);
    }

    public function create()
    {
        $bus_travel = BusTravels::all();

        $view = [
            'bus_travel' => $bus_travel,
        ];

        return view('ekstranet.bus-travel.create-bus-travel', $view);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'class' => 'required',
            'is_active' => 'required',
            'number_seats' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = auth()->user();
        $bus_travel = BusTravels::where('user_id', $user->id)->first();

        if (!$bus_travel) {
            return redirect()->route('partner.daftar.bus-travel')->with('error', 'Anda tidak memiliki bus & travel!');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('buses', $imageName, 'public');
        } else {
            $imageName = NULL;
        }

        $data = [
            'bus_travel_id' => $bus_travel->id,
            'name' => $request->name,
            'class' => $request->class,
            'is_active' => $request->is_active,
            'number_seats' => $request->number_seats,
            'image' => $imageName,
        ];

        Log::info($request->all());

        DB::table('bus_travel_has_buses')->insert($data);

        return redirect()->route('partner.daftar.bus-travel')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $bus = BusTravelHasBus::with('busTravel')
            ->where('id', $id)
            ->first();

        $view = [
            'bus' => $bus,
        ];

        return view('ekstranet.bus-travel.update', $view);
    }

    public function update(Request $request, $id)
    {
        $bus = BusTravelHasBus::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'class' => 'required',
            'is_active' => 'required',
            'number_seats' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('cars', $imageName, 'public');
        } else {
            $imageName = $bus->image;
        }

        $bus->name = $request->name;
        $bus->class = $request->class;
        $bus->is_active = $request->is_active;
        $bus->number_seats = $request->number_seats;
        $bus->image = $imageName;
        $bus->save();

        return redirect()->route('partner.daftar.bus-travel')->with('update', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $bus = BusTravelHasBus::find($id);
        $bus->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }
}

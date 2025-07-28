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
        $bus_travel = BusTravels::where('user_id', auth()->user()->id)->get();

        $view = [
            'bus_travel' => $bus_travel,
        ];

        return view('ekstranet.bus-travel.create-bus-travel', $view);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_travel_id' => 'required|exists:bus_travels,id',
            'name' => 'required',
            'class' => 'required',
            'is_active' => 'required',
            'number_seats' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('buses', $imageName, 'public');
        } else {
            $imageName = NULL;
        }

        $data = [
            'bus_travel_id' => $request->input('bus_travel_id'),
            'name' => $request->input('name'),
            'class' => $request->input('class'),
            'is_active' => $request->input('is_active'),
            'number_seats' => $request->input('number_seats'),
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
        $bus_travel = BusTravels::where('user_id', auth()->user()->id)->get();

        $view = [
            'bus' => $bus,
            'bus_travel' =>  $bus_travel
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
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            Storage::delete('buses/' . $bus->image);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('buses', $imageName, 'public');
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

        $img = $bus->image;
        if($img) {
            Storage::delete('buses/' . $img);
        }

        $bus->delete();

        return redirect()->back()->with('delete', 'Data berhasil dihapus!');
    }
}

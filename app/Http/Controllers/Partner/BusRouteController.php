<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BusRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusRouteController extends Controller
{
    /**
     * Display a listing of the bus routes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = BusRoute::orderBy('name', 'asc')->get();
        return view('ekstranet.bus-travel.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new bus route.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ekstranet.bus-travel.routes.create');
    }

    /**
     * Store a newly created bus route in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:bus_routes,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BusRoute::create([
            'name' => strtoupper($request->name),
        ]);

        return redirect()->route('partner.bus.routes')
            ->with('success', 'Rute bus berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified bus route.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = BusRoute::findOrFail($id);
        return view('ekstranet.bus-travel.routes.edit', compact('route'));
    }

    /**
     * Update the specified bus route in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $route = BusRoute::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:bus_routes,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $route->update([
            'name' => strtoupper($request->name),
        ]);

        return redirect()->route('partner.bus.routes')
            ->with('success', 'Rute bus berhasil diperbarui!');
    }

    /**
     * Remove the specified bus route from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = BusRoute::findOrFail($id);
        
        // Check if the route is being used in departures
        if ($route->departure_from()->count() > 0 || $route->departure_to()->count() > 0) {
            return redirect()->route('partner.bus.routes')
                ->with('error', 'Rute ini tidak dapat dihapus karena sedang digunakan dalam jadwal keberangkatan!');
        }
        
        $route->delete();

        return redirect()->route('partner.bus.routes')
            ->with('success', 'Rute bus berhasil dihapus!');
    }
}

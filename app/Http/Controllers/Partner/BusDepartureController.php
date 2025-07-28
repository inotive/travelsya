<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BusDeparture;
use App\Models\BusRoute;
use App\Models\BusTravelHasBus;
use App\Models\BusTravels;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusDepartureController extends Controller
{
    /**
     * Display a listing of bus departures.
     *
     * @param int|null $busId Optional bus ID to filter departures
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(): View|Factory
    {
        $user = Auth::user();

        // Get all bus travel businesses owned by the user
        $busTravels = BusTravels::where('user_id', $user->id)->get();
        $busTravelIds = $busTravels->pluck('id')->toArray();

        // Get all buses associated with these businesses
        $busIds = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->pluck('id')->toArray();

        // Get all departures for these buses
        $departures = BusDeparture::whereIn('bus_travel_has_bus_id', $busIds)
            ->with(['busTravel', 'from', 'to'])
            ->orderBy('departure_time', 'asc')
            ->get();

        // Get all routes for dropdowns in modals
        $routes = BusRoute::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        // Get the default bus for new departures (first bus of the user)
        $defaultBus = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->first();
        $defaultBusId = $defaultBus ? $defaultBus->id : null;

        return view('ekstranet.bus-travel.departures.index', compact('departures', 'routes', 'defaultBusId'));
    }

    /**
     * Show the form for creating a new bus departure.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        // Get all bus travel businesses owned by the user
        $busTravels = BusTravels::where('user_id', $user->id)->get();

        // Get all buses for these businesses
        $buses = [];
        foreach ($busTravels as $busTravel) {
            $busesForTravel = BusTravelHasBus::where('bus_travel_id', $busTravel->id)
                ->with('busTravel')
                ->get();

            foreach ($busesForTravel as $bus) {
                $buses[$bus->id] = $busTravel->business_name . ' - ' . $bus->name;
            }
        }

        // Get all routes
        $routes = BusRoute::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return view('ekstranet.bus-travel.departures.create', compact('buses', 'routes'));
    }

    /**
     * Store a newly created bus departure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Process days array into comma-separated string if it's an array
        $days = $request->days;
        if (is_array($days)) {
            $days = implode(',', $days);
        }

        // Get the user's default bus if not provided
        $user = Auth::user();
        $busTravelIds = BusTravels::where('user_id', $user->id)->pluck('id')->toArray();
        $defaultBus = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->first();

        if (!$defaultBus) {
            return redirect()->back()
                ->with('error', 'Anda belum memiliki bus yang terdaftar!')
                ->withInput();
        }

        $validator = Validator::make($request->all(), [
            'from_route_id' => 'required|exists:bus_routes,id',
            'to_route_id' => 'required|exists:bus_routes,id|different:from_route_id',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the bus travel associated with the default bus
        $busTravel = BusTravels::findOrFail($defaultBus->bus_travel_id);

        // Verify ownership
        if ($busTravel->user_id != $user->id) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses ke bus ini!')
                ->withInput();
        }

        // Create new departure
        $departure = new BusDeparture();
        $departure->bus_travel_has_bus_id = $defaultBus->id;
        $departure->from_route_id = $request->from_route_id;
        $departure->to_route_id = $request->to_route_id;
        
        // Combine departure date and time into a single datetime
        $departureDateTime = $request->departure_date . ' ' . $request->departure_time;
        $departure->departure_time = $departureDateTime;
        
        $departure->duration = $request->duration;
        $departure->price = $request->price;
        $departure->days = $days;
        $departure->save();

        return redirect()->route('partner.bus.departures')
            ->with('success', 'Jadwal keberangkatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified bus departure.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $departure = BusDeparture::with(['busTravel', 'from', 'to'])->findOrFail($id);

        // Verify ownership
        $busTravel = BusTravels::findOrFail($departure->busTravel->bus_travel_id);
        if ($busTravel->user_id != $user->id) {
            return redirect()->route('partner.bus.departures')
                ->with('error', 'Anda tidak memiliki akses ke jadwal keberangkatan ini!');
        }

        // Get all bus travel businesses owned by the user
        $busTravels = BusTravels::where('user_id', $user->id)->get();

        // Get all buses for these businesses
        $buses = [];
        foreach ($busTravels as $busTravel) {
            $busesForTravel = BusTravelHasBus::where('bus_travel_id', $busTravel->id)
                ->with('busTravel')
                ->get();

            foreach ($busesForTravel as $bus) {
                $buses[$bus->id] = $busTravel->business_name . ' - ' . $bus->name;
            }
        }

        // Get all routes
        $routes = BusRoute::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return view('ekstranet.bus-travel.departures.edit', compact('departure', 'buses', 'routes'));
    }

    /**
     * Update the specified bus departure in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): RedirectResponse
    {
        $departure = BusDeparture::findOrFail($request->id);

        // Verify ownership
        $user = Auth::user();
        $bus = BusTravelHasBus::findOrFail($departure->bus_travel_has_bus_id);
        $busTravel = BusTravels::findOrFail($bus->bus_travel_id);

        if ($busTravel->user_id != $user->id) {
            return redirect()->route('partner.bus.departures.index')
                ->with('error', 'Anda tidak memiliki akses ke jadwal keberangkatan ini!');
        }

        // Process days array into comma-separated string if it's an array
        $days = $request->days;
        if (is_array($days)) {
            $days = implode(',', $days);
        }

        $validator = Validator::make($request->all(), [
            'from_route_id' => 'required|exists:bus_routes,id',
            'to_route_id' => 'required|exists:bus_routes,id|different:from_route_id',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update departure details
        // Combine departure date and time into a single datetime
        $departureDateTime = $request->departure_date . ' ' . $request->departure_time;
        
        $departure->update([
            'from_route_id' => $request->from_route_id,
            'to_route_id' => $request->to_route_id,
            'departure_time' => $departureDateTime,
            'duration' => $request->duration,
            'price' => $request->price,
            'days' => $days,
        ]);

        return redirect()->route('partner.bus.departures.index')
            ->with('success', 'Jadwal keberangkatan berhasil diperbarui!');
    }

    /**
     * Remove the specified bus departure from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $id = $request->id;
        $departure = BusDeparture::findOrFail($id);

        // Verify ownership
        $user = Auth::user();
        $bus = BusTravelHasBus::findOrFail($departure->bus_travel_has_bus_id);
        $busTravel = BusTravels::findOrFail($bus->bus_travel_id);

        if ($busTravel->user_id != $user->id) {
            return redirect()->route('partner.bus.departures.index')
                ->with('error', 'Anda tidak memiliki akses ke jadwal keberangkatan ini!');
        }

        // Check if the departure is being used in bookings
        if ($departure->booked()->count() > 0) {
            return redirect()->route('partner.bus.departures.index')
                ->with('error', 'Jadwal keberangkatan ini tidak dapat dihapus karena sudah ada pemesanan!');
        }

        $departure->delete();

        return redirect()->route('partner.bus.departures.index')
            ->with('success', 'Jadwal keberangkatan berhasil dihapus!');
    }
}

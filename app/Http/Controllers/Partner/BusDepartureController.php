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
    public function index($busId = null): View|Factory
    {
        $user = Auth::user();
        $busTravels = BusTravels::where('user_id', $user->id)->get();
        $busTravelIds = $busTravels->pluck('id')->toArray();

        $busesQuery = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->with('busTravel');

        // Clone the query before filtering for the list of all buses
        $allBuses = $busesQuery->clone()->get()->mapWithKeys(function ($bus) {
            return [$bus->id => $bus->busTravel->business_name . ' - ' . $bus->name];
        });

        if ($busId) {
            $busesQuery->where('id', $busId);
        }

        $busIds = $busesQuery->pluck('id')->toArray();

        $departures = BusDeparture::whereIn('bus_travel_has_bus_id', $busIds)
            ->with(['busTravel', 'from', 'to'])
            ->orderBy('departure_time', 'asc')
            ->get();

        $routes = BusRoute::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        $defaultBusId = $busId ?: ($allBuses->keys()->first());

        return view('ekstranet.bus-travel.departures.index', compact('departures', 'routes', 'defaultBusId', 'allBuses'));
    }

    public function index2($busId = null): View|Factory
    {
        $user = Auth::user();
        $busTravelIds = BusTravels::where('user_id', $user->id)->pluck('id');
        $busesQuery = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->with('busTravel');
        $allBuses = $busesQuery->get()->mapWithKeys(fn($bus) =>
            [$bus->id => $bus->busTravel->business_name . ' - ' . $bus->name]
        );

        if ($busId) {
            $busesQuery->where('id', $busId);
        }

        $busIds = $busesQuery->pluck('id');

        $departures = BusDeparture::whereIn('bus_travel_has_bus_id', $busIds)
            ->with(['busTravel', 'from', 'to'])
            ->orderBy('departure_time')
            ->get();

        $routes = BusRoute::orderBy('name', 'asc')->pluck('name', 'id');

        return view('ekstranet.bus-travel.departures.index2', [
            'departures'   => $departures,
            'routes'       => $routes,
            'defaultBusId' => $busId ?: $allBuses->keys()->first(),
            'allBuses'     => $allBuses
        ]);
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
        $validator = Validator::make($request->all(), [
            'bus_travel_has_bus_id' => 'required|exists:bus_travel_has_buses,id',
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

        $user = Auth::user();
        $bus = BusTravelHasBus::with('busTravel')->findOrFail($request->bus_travel_has_bus_id);

        if ($bus->busTravel->user_id != $user->id) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses ke bus ini!')
                ->withInput();
        }

        $days = $request->days;
        if (is_array($days)) {
            $days = implode(',', $days);
        }

        $departureDateTime = $request->departure_date . ' ' . $request->departure_time;

        BusDeparture::create([
            'bus_travel_has_bus_id' => $request->bus_travel_has_bus_id,
            'from_route_id' => $request->from_route_id,
            'to_route_id' => $request->to_route_id,
            'departure_time' => $departureDateTime,
            'duration' => $request->duration,
            'price' => $request->price,
            'days' => $days,
        ]);

        return redirect()->route('partner.bus.departures.bus', ['busId' => $request->bus_travel_has_bus_id])
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
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:bus_departures,id',
            'bus_travel_has_bus_id' => 'required|exists:bus_travel_has_buses,id',
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

        $departure = BusDeparture::findOrFail($request->id);
        $user = Auth::user();

        // Verify ownership of the original departure
        $oldBus = BusTravelHasBus::with('busTravel')->findOrFail($departure->bus_travel_has_bus_id);
        if ($oldBus->busTravel->user_id != $user->id) {
            return redirect()->route('partner.bus.departures')
                ->with('error', 'Anda tidak memiliki akses ke jadwal keberangkatan ini!');
        }

        // Verify ownership of the new bus
        $newBus = BusTravelHasBus::with('busTravel')->findOrFail($request->bus_travel_has_bus_id);
        if ($newBus->busTravel->user_id != $user->id) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses ke bus yang dipilih!')
                ->withInput();
        }

        $days = $request->days;
        if (is_array($days)) {
            $days = implode(',', $days);
        }

        $departureDateTime = $request->departure_date . ' ' . $request->departure_time;

        $departure->update([
            'bus_travel_has_bus_id' => $request->bus_travel_has_bus_id,
            'from_route_id' => $request->from_route_id,
            'to_route_id' => $request->to_route_id,
            'departure_time' => $departureDateTime,
            'duration' => $request->duration,
            'price' => $request->price,
            'days' => $days,
        ]);

        return redirect()->route('partner.bus.departures.bus', ['busId' => $request->bus_travel_has_bus_id])
            ->with('success', 'Jadwal keberangkatan berhasil diperbarui!');
    }


    /**
     /**
 * Remove the specified bus departure from storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function delete(Request $request): RedirectResponse
{
    $id = $request->id;

    if (!$id) {
        return redirect()->route('partner.bus.departures')
            ->with('error', 'ID jadwal keberangkatan tidak valid!');
    }

    try {
        $departure = BusDeparture::findOrFail($id);

        // Verify ownership
        $user = Auth::user();
        $bus = BusTravelHasBus::findOrFail($departure->bus_travel_has_bus_id);
        $busTravel = BusTravels::findOrFail($bus->bus_travel_id);

        if ($busTravel->user_id != $user->id) {
            return redirect()->route('partner.bus.departures')
                ->with('error', 'Anda tidak memiliki akses ke jadwal keberangkatan ini!');
        }

        // Check if the departure has any bookings
        // You'll need to replace 'booked()' with the actual relationship name or query
        // For example, if you have a bookings relationship:
        // if ($departure->bookings()->count() > 0) {
        //     return redirect()->route('partner.bus.departures')
        //         ->with('error', 'Jadwal keberangkatan ini tidak dapat dihapus karena sudah ada pemesanan!');
        // }

        $departure->delete();

        return redirect()->route('partner.bus.departures')
            ->with('success', 'Jadwal keberangkatan berhasil dihapus!');

    } catch (\Exception $e) {
        return redirect()->route('partner.bus.departures')
            ->with('error', 'Terjadi kesalahan saat menghapus jadwal keberangkatan!');
    }
}
}

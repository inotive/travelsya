<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BusDeparture;
use App\Models\City;
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
    public function index(Request $request, $busId = null): View|Factory
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

        $departuresQuery = BusDeparture::whereIn('bus_travel_has_bus_id', $busIds)
            ->with(['busTravel', 'from', 'to']);

        $search = $request->input('search');
        if ($search) {
            $departuresQuery->where(function ($query) use ($search) {
                $query->where('titik_naik', 'like', '%' . $search . '%')
                    ->orWhere('titik_turun', 'like', '%' . $search . '%')
                    ->orWhereHas('from', function ($q) use ($search) {
                        $q->where('city_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('to', function ($q) use ($search) {
                        $q->where('city_name', 'like', '%' . $search . '%');
                    });
            });
        }

        $departures = $departuresQuery->orderBy('departure_time', 'asc')->get();

        $cities = City::orderBy('city_name', 'asc')->pluck('city_name', 'id')->toArray();

        $defaultBusId = $busId ?: ($allBuses->keys()->first());

        return view('ekstranet.bus-travel.departures.index', compact('departures', 'cities', 'defaultBusId', 'allBuses', 'search'));
    }

    public function index2(Request $request)
    {
        $user = Auth::user();
        $busTravelIds = BusTravels::where('user_id', $user->id)->pluck('id');

        // Base query for buses
        $busesQuery = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)->with('busTravel');

        // Get all buses for the filter dropdown
        $allBuses = $busesQuery->get()->mapWithKeys(fn($bus) =>
            [$bus->id => $bus->busTravel->business_name . ' - ' . $bus->name]
        );

        // Get selected bus from request for filtering
        $selectedBusId = $request->input('bus_id');

        // Start building the departures query
        $departuresQuery = BusDeparture::query()->with(['busTravel', 'from', 'to']);

        // Filter by selected bus if a specific bus is chosen
        if ($selectedBusId && $selectedBusId !== 'all') {
            $departuresQuery->where('bus_travel_has_bus_id', $selectedBusId);
        } else {
            // If "All" is selected or no specific bus, get all departures for the user's travels
            $userBusIds = $busesQuery->pluck('id');
            $departuresQuery->whereIn('bus_travel_has_bus_id', $userBusIds);
        }

        // Handle search query
        $search = $request->input('search');
        if ($search) {
            $departuresQuery->where(function ($query) use ($search) {
                $query->where('titik_naik', 'like', '%' . $search . '%')
                    ->orWhere('titik_turun', 'like', '%' . $search . '%')
                    ->orWhereHas('from', function ($q) use ($search) {
                        $q->where('city_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('to', function ($q) use ($search) {
                        $q->where('city_name', 'like', '%' . $search . '%');
                    });
            });
        }

        $departures = $departuresQuery->orderBy('departure_time')->get();

        $cities = City::orderBy('city_name', 'asc')->pluck('city_name', 'id');

        return view('ekstranet.bus-travel.departures.index2', [
            'departures'   => $departures,
            'cities'       => $cities,
            'defaultBusId' => $selectedBusId, // Pass selected bus to the view
            'allBuses'     => $allBuses,
            'search'       => $search, // Pass search term to the view
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
        // Get all cities
        $cities = City::orderBy('city_name', 'asc')->pluck('city_name', 'id')->toArray();

        return view('ekstranet.bus-travel.departures.create', compact('buses', 'cities'));
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
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id|different:from_city_id',
            'titik_naik' => 'required|string',
            'titik_turun' => 'required|string',
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

        $from_city_id = $request->input('from_city_id');
        $to_city_id = $request->input('to_city_id');

        $from_city = City::find($from_city_id);
        $to_city = City::find($to_city_id);

        if ($from_city) {
            BusRoute::firstOrCreate(['name' => $from_city->city_name]);
        }

        if ($to_city) {
            BusRoute::firstOrCreate(['name' => $to_city->city_name]);
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
            'from_city_id' => $request->from_city_id,
            'to_city_id' => $request->to_city_id,
            'titik_naik' => $request->titik_naik,
            'titik_turun' => $request->titik_turun,
            'departure_time' => $departureDateTime,
            'departure_date' => $request->departure_date,
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

        // Get all cities
        $cities = City::orderBy('city_name', 'asc')->pluck('city_name', 'id')->toArray();

        return view('ekstranet.bus-travel.departures.edit', compact('departure', 'buses', 'cities'));
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
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id|different:from_city_id',
            'titik_naik' => 'required|string',
            'titik_turun' => 'required|string',
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

        $from_city_id = $request->input('from_city_id');
        $to_city_id = $request->input('to_city_id');

        $from_city = City::find($from_city_id);
        $to_city = City::find($to_city_id);

        if ($from_city) {
            BusRoute::firstOrCreate(['name' => $from_city->city_name]);
        }

        if ($to_city) {
            BusRoute::firstOrCreate(['name' => $to_city->city_name]);
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
            'from_city_id' => $request->from_city_id,
            'to_city_id' => $request->to_city_id,
            'titik_naik' => $request->titik_naik,
            'titik_turun' => $request->titik_turun,
            'departure_time' => $departureDateTime,
            'departure_date' => $request->departure_date,
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

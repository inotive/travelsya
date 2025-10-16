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

        // Get user's bus travel IDs
        $busTravelIds = BusTravels::where('user_id', $user->id)->pluck('id');

        // Get all user's buses for dropdown
        $allBuses = BusTravelHasBus::whereIn('bus_travel_id', $busTravelIds)
            ->with('busTravel')
            ->get()
            ->mapWithKeys(function($bus) {
                return [$bus->id => $bus->busTravel->business_name . ' - ' . $bus->name];
            });

        // Get filter parameters
        $selectedBusId = $request->input('bus_id');
        $search = $request->input('search');

        // Build departures query
        $departures = BusDeparture::query()
            ->with(['busTravel.busTravel', 'from', 'to'])
            ->whereHas('busTravel', function($query) use ($busTravelIds) {
                $query->whereIn('bus_travel_id', $busTravelIds);
            })
            // Apply bus filter
            ->when($selectedBusId && $selectedBusId !== 'all', function($query) use ($selectedBusId) {
                $query->where('bus_travel_has_bus_id', $selectedBusId);
            })
            // Apply search filter
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('titik_naik', 'like', "%{$search}%")
                    ->orWhere('titik_turun', 'like', "%{$search}%")
                    ->orWhereHas('from', function($subQ) use ($search) {
                        $subQ->where('city_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('to', function($subQ) use ($search) {
                        $subQ->where('city_name', 'like', "%{$search}%");
                    });
                });
            })
            ->orderBy('departure_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->get();

        $cities = City::orderBy('city_name', 'asc')->pluck('city_name', 'id');

        return view('ekstranet.bus-travel.departures.index2', [
            'departures'   => $departures,
            'cities'       => $cities,
            'defaultBusId' => $selectedBusId ?: 'all',
            'allBuses'     => $allBuses,
            'search'       => $search,
        ]);
    }


    /**
     * Show the form for creating a new bus departure.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $redirectUrl = $request->input('redirect_to', route('partner.bus.departures'));


        return view('ekstranet.bus-travel.departures.create', compact('buses', 'cities', 'redirectUrl'));
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
            'redirect_url' => 'nullable|string',
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

        $redirectUrl = $request->input('redirect_url', route('partner.bus.departures'));


        return redirect($redirectUrl)->with('success', 'Jadwal keberangkatan berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified bus departure.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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

        $redirectUrl = $request->input('redirect_to', route('partner.bus.departures'));


        return view('ekstranet.bus-travel.departures.edit', compact('departure', 'buses', 'cities', 'redirectUrl'));
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
            'redirect_url' => 'nullable|string',
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

        $redirectUrl = $request->input('redirect_url', route('partner.bus.departures'));


        return redirect($redirectUrl)->with('success', 'Jadwal keberangkatan berhasil diperbarui!');
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
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:bus_departures,id',
        'redirect_url' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $id = $request->id;

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

        $bookings = \App\Models\DetailTransactionBus::where('bus_departure_id', $departure->id)->count();
        if ($bookings > 0) {
            return redirect()->back()
                ->with('error', 'Jadwal keberangkatan ini tidak dapat dihapus karena sudah ada pemesanan!');
        }

        $departure->delete();

        $redirectUrl = $request->input('redirect_url', route('partner.bus.departures'));


        return redirect($redirectUrl)->with('success', 'Jadwal keberangkatan berhasil dihapus!');

    } catch (\Exception $e) {
        $redirectUrl = $request->input('redirect_url', route('partner.bus.departures'));
        return redirect($redirectUrl)->with('error', 'Terjadi kesalahan saat menghapus jadwal keberangkatan!');
    }
}
}

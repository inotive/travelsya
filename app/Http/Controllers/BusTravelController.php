<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Helpers\ResponseFormatter;
use App\Models\BusBooked;
use App\Models\BusCostumerHasChair;
use App\Models\BusDeparture;
use App\Models\BusRoute;
use App\Models\BusTravels;
use App\Models\City;
use App\Models\DetailTransactionBus;
use App\Models\Fee;
use App\Models\Service;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusTravelController extends Controller
{
    protected $xendit, $point;

    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit = $xendit;
        $this->point = $point;
    }

    public function index()
    {
        $data['city'] = BusRoute::get()->pluck('name', 'name');

        // Get route relationships for filtering
        $routes = BusDeparture::with('from', 'to')->get();
        $routeData = [];
        foreach ($routes as $route) {
            $from = $route->from->city_name ?? '';
            $to = $route->to->city_name ?? '';

            if ($from && $to) {
                // Add to departure routes (from city -> to cities)
                if (!isset($routeData['departures'][$from])) {
                    $routeData['departures'][$from] = [];
                }
                if (!in_array($to, $routeData['departures'][$from])) {
                    $routeData['departures'][$from][] = $to;
                }

                // Add to destination routes (to city <- from cities)
                if (!isset($routeData['destinations'][$to])) {
                    $routeData['destinations'][$to] = [];
                }
                if (!in_array($from, $routeData['destinations'][$to])) {
                    $routeData['destinations'][$to][] = $from;
                }
            }
        }
        $data['routeData'] = $routeData;

        $popularRoutes = DetailTransactionBus::query()
            ->select('from', 'to', DB::raw('COUNT(*) as orders_count'))
            ->whereNotNull('from')
            ->whereNotNull('to')
            ->groupBy('from', 'to')
            ->orderByDesc('orders_count')
            ->limit(12)
            ->get();

        $data['route'] = $popularRoutes;

        $data['route_travel'] = BusDeparture::with(['from', 'to'])->latest()->limit(12)->get();

        $data['popular'] = BusTravels::withCount('booked')->orderBy('booked_count', 'desc')->limit(8)->get();

        return view('pagesv2.bus_travel.index', $data);
    }

    public function popularSearch($id)
    {
        $busTravel = BusTravels::find($id);

        if (!$busTravel) {
            return redirect()->route('bus_travel.index')->with('error', 'Bus operator not found.');
        }

        // Find a random departure associated with this bus travel operator
        $departure = BusDeparture::whereHas('busTravel.busTravel', function ($query) use ($id) {
            $query->where('id', $id);
        })->inRandomOrder()->first();

        if (!$departure) {
            // If no departures, maybe just search by agent name with no routes
            $request = new Request([
                'agent' => $busTravel->business_name,
                'kota_awal' => '',
                'kota_tujuan' => '',
                'date_pergi' => now()->format('Y-m-d'),
                'jumlah_penumpang' => 1,
                'is_pulang_pergi' => 0,
            ]);
            return $this->search($request);
        }

        // Create a new request with the random route data
        $request = new Request([
            'agent' => $busTravel->business_name,
            'kota_awal' => $departure->from->city_name,
            'kota_tujuan' => $departure->to->city_name,
            'date_pergi' => now()->format('Y-m-d'),
            'jumlah_penumpang' => 1,
            'is_pulang_pergi' => 0,
        ]);

        // Call the existing search method
        return $this->search($request);
    }

    /**
     * Enhanced search method that supports:
     * - Business name search
     * - Route name search (from city -> to city)
     * - Price range search (100K intervals)
     */
 public function search_ajax(Request $request)
    {
        $searchTerm = trim($request->name);
        $find = '%' . $searchTerm . '%';

        // Check search type
        $isNumericSearch = is_numeric(str_replace(['k', 'K', '.', ','], '', $searchTerm));
        $isTimeSearch = $this->isTimeSearch($searchTerm);
        $isFacilitySearch = $this->isFacilitySearch($searchTerm);

        $price = null;
        $timeRange = null;
        $facilityTerms = [];

        if ($isNumericSearch && !$isTimeSearch) {
            $cleanInput = str_replace(['k', 'K', '.', ','], '', $searchTerm);
            $price = (int) $cleanInput;
            if (stripos($searchTerm, 'k') !== false) {
                $price *= 1000;
            }
        } elseif ($isTimeSearch) {
            $timeRange = $this->calculateTimeRange($searchTerm);
        } elseif ($isFacilitySearch) {
            $facilityTerms = $this->getFacilitySearchTerms($searchTerm);
        }

        $buses = BusDeparture::with('busTravel', 'from', 'to')
            ->whereHas('busTravel', function ($q) use ($find, $price, $isNumericSearch, $isTimeSearch, $isFacilitySearch, $facilityTerms) {
                $q->whereHas('busTravel', function ($b) use ($find, $isNumericSearch, $isTimeSearch, $isFacilitySearch, $facilityTerms) {
                    // Search by business name if not numeric/time/facility
                    if (!$isNumericSearch && !$isTimeSearch && !$isFacilitySearch) {
                        $b->where('business_name', 'like', $find);
                    }

                    // Search by facilities
                    if ($isFacilitySearch && !empty($facilityTerms)) {
                        foreach ($facilityTerms as $facility) {
                            $b->orWhere('facilities', 'like', '%' . $facility . '%')
                              ->orWhere('description', 'like', '%' . $facility . '%')
                              ->orWhere('class', 'like', '%' . $facility . '%');
                        }
                    }
                });

                // Add price filter if numeric search
                if ($isNumericSearch && $price && !$isTimeSearch) {
                    $q->where('price', '<=', $price);
                }
            })
            // Add route name search if not numeric/time/facility
            ->when(!$isNumericSearch && !$isTimeSearch && !$isFacilitySearch, function ($query) use ($find) {
                $query->orWhereHas('from', function ($f) use ($find) {
                    $f->where('name', 'like', $find);
                })->orWhereHas('to', function ($t) use ($find) {
                    $t->where('name', 'like', $find);
                });
            })
            // Add price search for main departure table
            ->when($isNumericSearch && $price && !$isTimeSearch, function ($query) use ($price) {
                $query->orWhere('price', '<=', $price);
            })
            // Add time range search
            ->when($isTimeSearch && $timeRange, function ($query) use ($timeRange) {
                $query->orWhereTime('departure_time', '>=', $timeRange['start'])
                      ->whereTime('departure_time', '<=', $timeRange['end']);
            })
            ->limit(10)
            ->get();

        $result = '';

        if ($buses->isEmpty()) {
            return '<div class="text-center text-muted p-3">Tidak ada hasil ditemukan</div>';
        }

        foreach ($buses as $bus) {
            $businessName = $bus['busTravel']['busTravel']['business_name'] ?? 'Invalid bus';
            $fromCity = $bus['from']['name'] ?? 'Invalid Route';
            $toCityName = $bus['to']['name'] ?? 'Invalid Route';
            $price = number_format($bus['price'] ?? 0, 0, ',', '.');

            // Highlight search term in results if not numeric
            if (!$isNumericSearch) {
                $businessName = $this->highlightSearchTerm($businessName, $searchTerm);
                $fromCity = $this->highlightSearchTerm($fromCity, $searchTerm);
                $toCityName = $this->highlightSearchTerm($toCityName, $searchTerm);
            }

            $result .= '<a href="' .
                route(
                    'bus_travel.detail',
                    [
                        'departure_id' => $bus['id'],
                        'kota_awal' => ($bus['from']['name'] ?? null),
                        'kota_tujuan' => ($bus['to']['name'] ?? null),
                        'is_pulang_pergi' => 0,
                        'jumlah_penumpang' => 1,
                        'date_pergi' => date('d-m-Y', strtotime(now())),
                        'date_pulang' => null
                    ]
                ) . '" class="d-flex w-100 flex-stack">
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <span class="text-gray-800 text-hover-primary fs-6 fw-bold text-capitalize">'
                . $fromCity . ' → ' . $toCityName .
                '</span>
                            <span class="text-muted fw-semibold d-block fs-7">
                                ' . $businessName . '
                            </span>
                            <span class="text-success fw-bold d-block fs-8">
                                Rp ' . $price . '
                            </span>
                        </div>
                    </div>
                </a>
                <hr>';
        }

        return $result;
    }

    /**
     * Check if search term is time-related
     */
    private function isTimeSearch($input)
    {
        // Check for patterns like: "3", "03", "jam 3", "3:00", "03:00", "15:30"
        $timePatterns = [
            '/^(jam\s*)?([0-2]?[0-9])$/i',          // "jam 3", "3", "03"
            '/^([0-2]?[0-9]):([0-5][0-9])$/',       // "3:00", "15:30"
            '/^([0-2]?[0-9])\.([0-5][0-9])$/',      // "3.00", "15.30"
        ];

        foreach ($timePatterns as $pattern) {
            if (preg_match($pattern, trim($input))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if search term is facility-related
     */
    private function isFacilitySearch($input)
    {
        $facilityKeywords = [
            'ac', 'air conditioner', 'full ac', 'ac full',
            'recliner', 'kursi recliner', 'seat recliner',
            'colokan', 'charger', 'usb', 'power outlet',
            'wifi', 'wi-fi', 'internet',
            'toilet', 'wc', 'kamar mandi',
            'tv', 'entertainment', 'hiburan',
            'bantal', 'pillow', 'selimut', 'blanket',
            'snack', 'makanan', 'minuman', 'refreshment'
        ];

        $searchLower = strtolower(trim($input));

        foreach ($facilityKeywords as $keyword) {
            if (strpos($searchLower, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Calculate time range based on input (3-hour intervals)
     */
    private function calculateTimeRange($input)
    {
        // Extract hour from various formats
        $hour = null;

        // Pattern: "jam 3", "3", "03"
        if (preg_match('/^(jam\s*)?([0-2]?[0-9])$/i', trim($input), $matches)) {
            $hour = (int) $matches[2];
        }
        // Pattern: "3:00", "15:30" - use hour part
        elseif (preg_match('/^([0-2]?[0-9]):([0-5][0-9])$/', trim($input), $matches)) {
            $hour = (int) $matches[1];
        }
        // Pattern: "3.00", "15.30" - use hour part
        elseif (preg_match('/^([0-2]?[0-9])\.([0-5][0-9])$/', trim($input), $matches)) {
            $hour = (int) $matches[1];
        }

        if ($hour === null || $hour > 23) {
            return null;
        }

        // Calculate 3-hour range
        $rangeStart = floor($hour / 3) * 3;
        $rangeEnd = $rangeStart + 3;

        // Handle edge case for last range of the day
        if ($rangeEnd > 24) {
            $rangeEnd = 24;
        }

        return [
            'start' => sprintf('%02d:00:00', $rangeStart),
            'end' => sprintf('%02d:00:00', $rangeEnd)
        ];
    }

    /**
     * Get facility search terms
     */
    private function getFacilitySearchTerms($input)
    {
        $searchLower = strtolower(trim($input));
        $facilityMap = [
            // AC related
            'ac' => ['ac', 'air conditioner', 'pendingin'],
            'full ac' => ['full ac', 'ac full', 'full air conditioner'],

            // Seat related
            'recliner' => ['recliner', 'kursi recliner', 'seat recliner'],
            'kursi recliner' => ['recliner', 'kursi recliner', 'seat recliner'],

            // Power related
            'colokan' => ['colokan', 'charger', 'usb', 'power', 'charging'],
            'charger' => ['colokan', 'charger', 'usb', 'power', 'charging'],
            'usb' => ['colokan', 'charger', 'usb', 'power', 'charging'],

            // Internet
            'wifi' => ['wifi', 'wi-fi', 'internet'],
            'wi-fi' => ['wifi', 'wi-fi', 'internet'],
            'internet' => ['wifi', 'wi-fi', 'internet'],

            // Comfort
            'toilet' => ['toilet', 'wc', 'kamar mandi'],
            'wc' => ['toilet', 'wc', 'kamar mandi'],
            'bantal' => ['bantal', 'pillow', 'selimut', 'blanket'],
            'selimut' => ['bantal', 'pillow', 'selimut', 'blanket'],

            // Entertainment & Food
            'tv' => ['tv', 'entertainment', 'hiburan'],
            'snack' => ['snack', 'makanan', 'minuman', 'refreshment'],
            'makanan' => ['snack', 'makanan', 'minuman', 'refreshment'],
        ];

        $matchedTerms = [];
        foreach ($facilityMap as $key => $synonyms) {
            if (strpos($searchLower, $key) !== false) {
                $matchedTerms = array_merge($matchedTerms, $synonyms);
                break; // Use first match to avoid duplicates
            }
        }

        return array_unique($matchedTerms);
    }



    /**
     * Highlight search term in text (case insensitive)
     */
    private function highlightSearchTerm($text, $searchTerm)
    {
        if (empty($searchTerm) || strlen($searchTerm) < 2) {
            return $text;
        }

        return preg_replace(
            '/(' . preg_quote($searchTerm, '/') . ')/i',
            '<mark class="bg-warning">$1</mark>',
            $text
        );
    }

    /**
     * Enhanced search method for main search functionality
     */
    public function search(Request $request, $agent = null)
    {
        // Log that we've reached the search method
        \Log::info('BusTravelController@search called', [
            'method' => $request->method(),
            'all_inputs' => $request->all()
        ]);

        // Validate required fields
        $request->validate([
            'kota_awal' => 'nullable|string',
            'kota_tujuan' => 'nullable|string',
            'date_pergi' => 'required|date',
            'jumlah_penumpang' => 'required|integer|min:1',
            'is_pulang_pergi' => 'required|in:0,1'
        ], [
            'kota_awal.required' => 'Kota awal wajib diisi.',
            'kota_tujuan.required' => 'Kota tujuan wajib diisi.',
            'date_pergi.required' => 'Tanggal pergi wajib diisi.',
            'date_pergi.date' => 'Format tanggal pergi tidak valid.',
            'jumlah_penumpang.required' => 'Jumlah penumpang wajib diisi.',
            'jumlah_penumpang.integer' => 'Jumlah penumpang harus berupa angka.',
            'jumlah_penumpang.min' => 'Jumlah penumpang minimal 1.',
            'is_pulang_pergi.required' => 'Pilihan pulang pergi wajib diisi.',
            'is_pulang_pergi.in' => 'Pilihan pulang pergi tidak valid.'
        ]);

        $date = $request->date_pergi ?? now()->format('Y-m-d');
        $date_pulang = $request->date_pulang ?? null;
        $qty = $request->jumlah_penumpang ?: 1;
        $pp = $request->is_pulang_pergi ?? 0;
        $selected_agent = $request->agent ? '%' . $request->agent . '%' : null;

        // Get route relationships for filtering
        $routes = BusDeparture::with('from', 'to')->get();
        $routeData = [];
        foreach ($routes as $route) {
            $from = $route->from->city_name ?? '';
            $to = $route->to->city_name ?? '';

            if ($from && $to) {
                if (!isset($routeData['departures'][$from])) {
                    $routeData['departures'][$from] = [];
                }
                if (!in_array($to, $routeData['departures'][$from])) {
                    $routeData['departures'][$from][] = $to;
                }
                if (!isset($routeData['destinations'][$to])) {
                    $routeData['destinations'][$to] = [];
                }
                if (!in_array($from, $routeData['destinations'][$to])) {
                    $routeData['destinations'][$to][] = $from;
                }
            }
        }

        // Parse price if provided
        $price = null;
        if ($request->price) {
            $cleanInput = str_replace(['k', 'K', '.', ','], '', $request->price);
            $price = (int) $cleanInput;
            if (stripos($request->price, 'k') !== false) {
                $price *= 1000;
            }
        }

        // Parse time range if provided
        $timeRange = null;
        if ($request->time) {
            $timeRange = $this->calculateTimeRange($request->time);
        }

        // Parse facility search terms
        $facilityTerms = [];
        if ($request->facility) {
            $facilityTerms = $this->getFacilitySearchTerms($request->facility);
        }

        // --- BASE QUERY BUILDER ---
        $baseQuery = function () use ($request, $date, $date_pulang, $pp) {
            $dayOfWeekPergi = $date ? date('w', strtotime($date)) : null;
            $dayOfWeekPulang = $date_pulang ? date('w', strtotime($date_pulang)) : null;
            $dayNames = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

            $pergiQuery = BusDeparture::with('busTravel.busTravel', 'from', 'to', 'busTravel.facilities.facility')
                ->has('busTravel')
                ->when($request->kota_awal, fn($q) => $q->whereHas('from', fn($f) => $f->where('city_name', 'like', '%' . $request->kota_awal . '%')))
                ->when($request->kota_tujuan, fn($q) => $q->whereHas('to', fn($t) => $t->where('city_name', 'like', '%' . $request->kota_tujuan . '%')))
                ->when($date, fn($q) => $q->whereDate('departure_time', $date))
                ->when($dayOfWeekPergi !== null, fn($q) => $q->where('days', 'like', '%' . $dayNames[$dayOfWeekPergi] . '%'));

            $pulangQuery = null;
            if ((int)$pp === 1) {
                $pulangQuery = BusDeparture::with('busTravel.busTravel', 'from', 'to', 'busTravel.facilities.facility')
                    ->has('busTravel')
                    ->when($request->kota_awal, fn($q) => $q->whereHas('to', fn($t) => $t->where('city_name', 'like', '%' . $request->kota_awal . '%')))
                    ->when($request->kota_tujuan, fn($q) => $q->whereHas('from', fn($f) => $f->where('city_name', 'like', '%' . $request->kota_tujuan . '%')))
                    ->when($date_pulang, fn($q) => $q->whereDate('departure_time', $date_pulang))
                    ->when($dayOfWeekPulang !== null, fn($q) => $q->where('days', 'like', '%' . $dayNames[$dayOfWeekPulang] . '%'));
            }
            return [$pergiQuery, $pulangQuery];
        };

        // --- GET ALL AGENTS FOR THE CURRENT ROUTE ---
        list($pergiQueryForAgents, $pulangQueryForAgents) = $baseQuery();
        $pergiForAgents = $pergiQueryForAgents->get();
        $pulangForAgents = $pulangQueryForAgents ? $pulangQueryForAgents->get() : collect();
        $availableAgentIds = $pergiForAgents->pluck('busTravel.busTravel.id')
            ->merge($pulangForAgents->pluck('busTravel.busTravel.id'))
            ->unique()
            ->filter();
        $agents = BusTravels::Active()
            ->whereIn('id', $availableAgentIds)
            ->get();

        // --- GET FILTERED RESULTS ---
        list($pergiQuery, $pulangQuery) = $baseQuery();
        $pergi = $pergiQuery
            ->when($selected_agent, fn($q, $a) => $q->whereHas('busTravel.busTravel', fn($b) => $b->where('business_name', 'like', $a)))
            ->when($price, fn($q) => $q->where('price', '<=', $price))
            ->when($timeRange, fn($q) => $q->whereTime('departure_time', '>=', $timeRange['start'])->whereTime('departure_time', '<=', $timeRange['end']))
            ->when(!empty($facilityTerms), function ($q) use ($facilityTerms) {
                $q->whereHas('busTravel', function ($bus) use ($facilityTerms) {
                    foreach ($facilityTerms as $term) {
                        $bus->where('facilities', 'like', '%' . $term . '%')
                            ->orWhere('description', 'like', '%' . $term . '%')
                            ->orWhere('class', 'like', '%' . $term . '%');
                    }
                });
            })
            ->get();

        $pulang = [];
        if ($pulangQuery) {
            $pulang = $pulangQuery
                ->when($selected_agent, fn($q, $a) => $q->whereHas('busTravel.busTravel', fn($b) => $b->where('business_name', 'like', $a)))
                ->when($price, fn($q) => $q->where('price', '<=', $price))
                ->when($timeRange, fn($q) => $q->whereTime('departure_time', '>=', $timeRange['start'])->whereTime('departure_time', '<=', $timeRange['end']))
                ->when(!empty($facilityTerms), function ($q) use ($facilityTerms) {
                    $q->whereHas('busTravel', function ($bus) use ($facilityTerms) {
                        foreach ($facilityTerms as $term) {
                            $bus->where('facilities', 'like', '%' . $term . '%')
                                ->orWhere('description', 'like', '%' . $term . '%')
                                ->orWhere('class', 'like', '%' . $term . '%');
                        }
                    });
                })
                ->get();
        }

        // Format the bus data
        $formattedPergi = $this->formatBus($pergi, $date);
        $formattedPulang = $this->formatBus($pulang, $date_pulang);

        // Check if there are no departures for the selected date but the route exists
        $noDeparturesFound = false;
        if (empty($formattedPergi) && $request->kota_awal && $request->kota_tujuan && $date) {
            $anyRouteDepartures = BusDeparture::with('from', 'to')
                ->whereHas('from', fn($f) => $f->where('city_name', 'like', '%' . $request->kota_awal . '%'))
                ->whereHas('to', fn($t) => $t->where('city_name', 'like', '%' . $request->kota_tujuan . '%'))
                ->exists();

            if ($anyRouteDepartures) {
                $noDeparturesFound = true;
            }
        }

        $newData = [
            'agent' => $agents,
            'selected_agent' => $request->agent ?? null,
            'selected_price_range' => $request->price ?? null,
            'selected_time_range' => $request->time ?? null,
            'selected_facility' => $request->facility ?? null,
            'is_pulang_pergi' => $pp,
            'kota_awal' => $request->kota_awal,
            'kota_tujuan' => $request->kota_tujuan,
            'date_pergi' => $request->date_pergi,
            'date_pulang' => $request->date_pulang,
            'jumlah_penumpang' => $qty,
            'pergi' => $formattedPergi,
            'pulang' => $formattedPulang,
            'city' => BusRoute::pluck('name', 'name'),
            'routeData' => $routeData,
            'noDeparturesFound' => $noDeparturesFound,
        ];

        return view('pagesv2.bus_travel.search_result', $newData);
    }


    public function findByRoute($kota_awal, $kota_tujuan)
    {
        $from = '%' . $kota_awal . '%';
        $to = '%' . $kota_tujuan . '%';
        $date = now()->format('Y-m-d');
        $date_pulang = null;
        $qty = 1;
        $pp = 0;
        $selected_agent = null;

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('city_name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('city_name', 'like', $to);
            })
            ->when($selected_agent, function ($q, $a) {
                $q->whereHas('busTravel.busTravel', function ($b2) use ($a) {
                    $b2->where('business_name', 'like', $a);
                });
            })
            ->get();

        $pulang = [];

        if ((int)$pp == 1) {
            $pulang = BusDeparture::with('busTravel', 'from', 'to')
                ->has('busTravel')
                ->whereHas('to', function ($f) use ($from) {
                    $f->where('city_name', 'like', $from);
                })
                ->whereHas('from', function ($t) use ($to) {
                    $t->where('city_name', 'like', $to);
                })
                ->when($selected_agent, function ($q, $a) {
                    $q->whereHas('busTravel', function ($b) use ($a) {
                        $b->whereHas('busTravel', function ($b2) use ($a) {
                            $b2->where('business_name', 'like', $a);
                        });
                    });
                })
                ->get();
        }

        $newData['agent'] = BusTravels::Active()->get();
        $newData['selected_agent'] = null;

        $newData['is_pulang_pergi'] = $pp;
        $newData['kota_awal'] = $kota_awal;
        $newData['kota_tujuan'] = $kota_tujuan;
        $newData['date_pergi'] = $date;
        $newData['date_pulang'] = null;
        $newData['jumlah_penumpang'] = $qty;
        $newData['pergi'] = $this->formatBus($pergi, $date);
        $newData['pulang'] = $this->formatBus($pulang, $date_pulang);
        $newData['city'] = BusRoute::get()->pluck('name', 'name');

        return view('pagesv2.bus_travel.search_result', $newData);
    }

    public function formatSingleBus($collection, $date = null)
    {
        $available = General::busAvailableTicket($collection, $date);
        $item = [
            'id' => $collection['id'],
            'business_name' => $collection['busTravel']['busTravel']['business_name'] ?? 'Deleted business',
            'class' => $collection['busTravel']['class'],
            'departure_point' => $collection['from']['name'] ?? 'Deleted point',
            'departure_time' => Carbon::parse($collection['departure_time'])->format('H:i'),
            'arrival_point' => $collection['to']['name'] ?? 'Deleted point',
            'arrival_time' => Carbon::parse($collection['departure_time'])->addHours($collection['duration'] ?? 1)->format('H:i'),
            'price' => $collection['price'],
            'available_tickets' => $available,
        ];

        return $item;
    }

    public function formatBus($collections, $date = null)
    {
        $newTicket = [];

        foreach ($collections as $key => $val) {
            $available = General::busAvailableTicket($val, $date);
            $item = [
                'id' => $val['id'],
                'business_name' => $val['busTravel']['busTravel']['business_name'] ?? 'Deleted business',
                'name' => $val['busTravel']['name'] ?? 'Deleted business',
                'class' => $val['busTravel']['class'],
                'departure_point' => $val['from']['city_name'] ?? 'Deleted point',
                'titik_naik' => $val['titik_naik'],
                'departure_time' => Carbon::parse($val['departure_time'])->format('H:i'),
                'arrival_point' => $val['to']['city_name'] ?? 'Deleted point',
                'titik_turun' => $val['titik_turun'],
                'arrival_time' => Carbon::parse($val['departure_time'])->addHours($val['duration'] ?? 1)->format('H:i'),
                'price' => $val['price'],
                'duration' => $val['duration'],
                'avgRating' => $val->busTravel->avgRating(),
                'reviews' => $val->busTravel->reviews,
                'available_tickets' => $available,
                'facilities' => $val->busTravel->facilities,
            ];

            array_push($newTicket, $item);
        }

        return $newTicket;
    }

    public function detail(Request $request, $departure_id, $kota_awal, $kota_tujuan, $is_pulang_pergi, $jumlah_penumpang, $date_pergi, $date_pulang = null)
    {
        $param = $request;

        $data['departure_id'] = $departure_id;
        $data['kota_awal'] = $kota_awal;
        $data['kota_tujuan'] = $kota_tujuan;
        $data['is_pulang_pergi'] = $is_pulang_pergi;
        $data['jumlah_penumpang'] = $jumlah_penumpang;
        $data['date_pergi'] = $date_pergi;
        $data['date_pulang'] = $date_pulang;

        $data['departure'] = BusDeparture::with(['busTravel.busTravel', 'busTravel.facilities.facility', 'from', 'to'])->find($param['departure_id']);
        $data['choosedChairs'] = BusCostumerHasChair::select('kursi_pergi')->where('id_departure', $departure_id)->where('date_pergi', $date_pergi)->where('is_active', 1)->orderBy('kursi_pergi')->get();
        // dd($data['departure']->busTravel->number_seats%2);

        return view('pagesv2.bus_travel.detail', $data);
    }

    public function order(Request $request)
    {
        // dd($request);
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }
        $param = $request;

        $data['is_pulang_pergi'] = $param['is_pulang_pergi'];
        $data['departure_id'] = $param['departure_id'];
        $data['kota_awal'] = $param['kota_awal'];
        $data['kota_tujuan'] = $param['kota_tujuan'];
        $data['jumlah_penumpang'] = $param['jumlah_penumpang'];
        $data['date_pergi'] = $param['date_pergi'];
        $data['date_pulang'] = $param['date_pulang'];
        $data['is_order'] = 1;
        for ($i = 1; $i <= $param['jumlah_penumpang']; $i++) {
            $data['kursi_penumpang_' . $i] = $param['kursi_penumpang_' . $i];
        }

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);
        $data['user'] = $user;

        $service = Service::where('name', 'bus-travel')->first();

        $data['service_id'] = $service->id;
        $data['choosedChairs'] = BusCostumerHasChair::select('kursi_pergi')->where('id_departure', $param['departure_id'])->where('date_pergi', $param['date_pergi'])->where('is_active', 1)->orderBy('kursi_pergi')->get();

        // dd($data);

        return view('pagesv2.bus_travel.order', $data);
    }

    public function request_transaction(Request $request)
    {
        // Fix the loop condition - should be <= not <
        for ($i = 1; $i <= $request->jumlah_penumpang; $i++) {
            $data_kursi = [
                'id_costumer' => auth()->user()->id,
                'id_departure' => $request->ticket_pergi_id,
                'penumpang_ke' => $i,
                'is_pulang_pergi' => $request->is_pulang_pergi,
                'date_pergi' => $request->date_pergi,
                'date_pulang' => $request->date_pulang ? $request->date_pulang : null,
                'kursi_pergi' => $request->{"kursi_penumpang_$i"} ?? null,
                'kursi_pulang' => '',
            ];

            BusCostumerHasChair::create($data_kursi);
        }


        $validator = Validator::make($request->all(), [
            'service' => 'required|string',
            'payment' => 'required|string',
            'ticket_pergi_id' => 'required',
            'point' => 'required',
            'date_pergi' => 'required|date',
            'jumlah_penumpang' => 'required|integer',
            'is_pulang_pergi' => 'required',
            'is_same' => 'required',
        ]);

        if ((int)$request->is_same == 0) {
            $validator = Validator::make($request->all(), [
                'customer_call_1' => 'required',
                'customer_name_1' => 'required',
                'customer_phone_1' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Bus Travel process failed',
                    500,
                );
            }

            $customer = [
                'name' => $request->customer_call_1 . ' ' . $request->customer_name_1,
                'phone' => $request->customer_phone_1,
                'email' => $request->customer_email_1,
            ];
        } else {
            $customer = [
                'name' => Auth::user()->name,
                'phone' => Auth::user()->phone ?? '000000000000',
                'email' => Auth::user()->email,
            ];
        }

        $data = $request->all();

        $pulang = [];

        $total = 0;

        if ((int) $data['is_pulang_pergi'] == 1) {
            $validator = Validator::make($request->all(), [
                'date_pulang' => 'required|date',
                'ticket_pulang_id' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(
                    [
                        'response' => $validator->errors(),
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            // Ensure proper relationship loading
            $pulang = BusDeparture::with([
                'busTravel.busTravel', 
                'from:id,city_name', 
                'to:id,city_name'
            ])->find($data['ticket_pulang_id']);

            if (!$pulang) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Paket tiket pergi tidak ditemukan ',
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            $dateTimePulang = $data['date_pulang'] . ' ' . $pulang->departure_time;

            $berangkatPulang =  Carbon::parse($dateTimePulang)->format('Y-m-d H:i');

            $total += $pulang->price;
        } else {
            $berangkatPulang = null;
        }

        $data = $request->all();

        // Ensure proper relationship loading with specific columns
        $pergi = BusDeparture::with([
            'busTravel.busTravel:id,business_name', 
            'from:id,city_name', 
            'to:id,city_name'
        ])->find($data['ticket_pergi_id']);
        
        if (!$pergi) {
            return ResponseFormatter::error(
                [
                    'message' => 'Paket tiket pergi tidak ditemukan',
                ],
                'Bus & Travel process failed',
                500,
            );
        }
        
        $dateTimePergi = $data['date_pergi'] . ' ' . $pergi->departure_time;
        $berangkat =  Carbon::parse($dateTimePergi)->format('Y-m-d H:i');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('bus_travel') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $pergi->price);

        $kali = (int)$data['is_pulang_pergi'] == 1 ? 2 : 1;

        $total += $pergi->price;

        $amount = $total * $data['jumlah_penumpang'];

        $kode_unik = random_int(0, 999);

        $fee = Fee::whereHas('service', function ($s) use ($data) {
            $s->where('name', $data['service']);
        })->first();

        $fees = [
            [
                'type' => 'Admin',
                'value' => $fee->percent == 0 ? $fee->value : ($amount * $fee->value) / 100,
            ],
            [
                'type' => 'Kode Unik',
                'value' => $kode_unik,
            ],
        ];

        $saldoPointCustomer = 0;
        // Jika user menggunakan point untuk transaksi
        if ($request->point == 1) {
            $saldoPointCustomer = Auth::user()->point;
            $fees = [
                [
                    'type' => 'Point',
                    'value' => $saldoPointCustomer,
                ],
            ];
        }

        // Safely access relationship data
        $business = $pergi->busTravel->busTravel->business_name ?? 'Deleted business';
        $fromCity = $pergi->from->city_name ?? 'Unknown';
        $toCity = $pergi->to->city_name ?? 'Unknown';
        
        $title = 'Pembelian ticket ' . $business . ((int)$data['is_pulang_pergi'] == 1 ? ' Pulang Pergi ' : ' ') . $fromCity . ' - ' . $toCity . ' untuk tanggal ' . $berangkat;

        // Create xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    'product_id' => $data['ticket_pergi_id'],
                    'name' => $title,
                    'price' => $amount, // tanpa pajak
                    'quantity' => $data['jumlah_penumpang'] * $kali,
                ],
            ],
            'amount' => $amount + $fees[0]['value'] + $kode_unik, // include pajak
            'success_redirect_url' => route('user.orderHistory'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $customer['name'],
                'email' => $customer['email'],
                'mobile_number' => $customer['phone'],
            ],
            'fees' => $fees,
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $berangkat, $berangkatPulang, $customer, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $pergi, $pulang, $saldoPointCustomer, $fromCity, $toCity) {
            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'BNT-' . time(),
                'service' => $data['service'],
                'service_id' => $service['id'],
                'payment' => $data['payment'],
                'user_id' => Auth::user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount + $fees[0]['value'] + $kode_unik,
            ]);
            // Pengurangan Point
            if ($request->point == 1) {
                $point = new Point();
                $point->deductPoint($request->user()->id, $saldoPointCustomer, $storeTransaction->id);
            }

            $booking_id = \Illuminate\Support\Str::random(6);

            for ($i = 1; $i <= $data['jumlah_penumpang']; $i++) {
                // Safely access relationship data
                $pergiFrom = $pergi->from->city_name ?? 'Unknown';
                $pergiTo = $pergi->to->city_name ?? 'Unknown';

                DetailTransactionBus::create([
                    "transaction_id" => $storeTransaction->id,
                    "bus_travel_id" => $pergi->busTravel->busTravel->id,
                    "bus_travel_has_bus_id" => $pergi->busTravel->id,
                    "bus_departure_id" => $pergi->id,
                    "booking_id" => $booking_id,
                    "departure_time" => $berangkat,
                    "from" => $pergiFrom,
                    "to" => $pergiTo,
                    "price" => $pergi->price,
                    "fee_admin" => $fees[0]['value'] / $data['jumlah_penumpang'],
                    "kode_unik" => $kode_unik,
                    "customer_name" => ($request['customer_call_' . $i] ?? '') . ' ' . ($request['customer_name_' . $i] ?? ''),
                    "customer_phone" => $request['customer_phone_' . $i] ?? '',
                    "customer_email" => $request['customer_email_' . $i] ?? '',
                ]);

                if ((int)$data['is_pulang_pergi'] == 1) {
                    // Safely access relationship data for pulang
                    $pulangFrom = $pulang->from->city_name ?? 'Unknown';
                    $pulangTo = $pulang->to->city_name ?? 'Unknown';
                    
                    DetailTransactionBus::create([
                        "transaction_id" => $storeTransaction->id,
                        "bus_travel_id" => $pulang->busTravel->busTravel->id,
                        "bus_travel_has_bus_id" => $pulang->busTravel->id,
                        "bus_departure_id" => $pulang->id,
                        "booking_id" => $booking_id,
                        "departure_time" => $berangkatPulang,
                        "from" => $pulangFrom,
                        "to" => $pulangTo,
                        "price" => $pulang->price,
                        "fee_admin" => 0,
                        "kode_unik" => $kode_unik,
                        "customer_name" => ($request['customer_call_' . $i] ?? '') . ' ' . ($request['customer_name_' . $i] ?? ''),
                        "customer_phone" => $request['customer_phone_' . $i] ?? '',
                        "customer_email" => $request['customer_email_' . $i] ?? '',
                    ]);
                }
            }
        });

        return redirect()->away($payoutsXendit['invoice_url']);
    }
}

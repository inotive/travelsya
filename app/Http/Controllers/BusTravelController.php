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

        $priceRange = null;
        $timeRange = null;
        $facilityTerms = [];

        if ($isNumericSearch && !$isTimeSearch) {
            $priceRange = $this->calculatePriceRange($searchTerm);
        } elseif ($isTimeSearch) {
            $timeRange = $this->calculateTimeRange($searchTerm);
        } elseif ($isFacilitySearch) {
            $facilityTerms = $this->getFacilitySearchTerms($searchTerm);
        }

        $buses = BusDeparture::with('busTravel', 'from', 'to')
            ->whereHas('busTravel', function ($q) use ($find, $priceRange, $isNumericSearch, $isTimeSearch, $isFacilitySearch, $facilityTerms) {
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

                // Add price range filter if numeric search
                if ($isNumericSearch && $priceRange && !$isTimeSearch) {
                    $q->whereBetween('price', [$priceRange['min'], $priceRange['max']]);
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
            // Add price range search for main departure table
            ->when($isNumericSearch && $priceRange && !$isTimeSearch, function ($query) use ($priceRange) {
                $query->orWhereBetween('price', [$priceRange['min'], $priceRange['max']]);
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
     * Calculate price range based on input
     * Every 100K increment (0-100K, 100K-200K, etc.)
     */
    private function calculatePriceRange($input)
    {
        // Clean the input - remove K, k, dots, commas
        $cleanInput = str_replace(['k', 'K', '.', ','], '', $input);

        if (!is_numeric($cleanInput)) {
            return null;
        }

        $price = (int) $cleanInput;

        // Handle K notation (e.g., 75K = 75000)
        if (stripos($input, 'k') !== false) {
            $price = $price * 1000;
        }

        // Calculate which 100K range this falls into
        $rangeIndex = floor($price / 100000);

        return [
            'min' => $rangeIndex * 100000,
            'max' => ($rangeIndex + 1) * 100000
        ];
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
        $from = '%' . $request->kota_awal . '%';
        $to = '%' . $request->kota_tujuan . '%';
        $date = $request->date_pergi ?? now()->format('Y-m-d');
        $date_pulang = $request->date_pulang ?? null;
        $qty = $request->jumlah_penumpang ? $request->jumlah_penumpang : 1;
        $pp = $request->is_pulang_pergi ?? 0;
        $selected_agent = $request->agent ? '%' . $request->agent . '%' : null;

        // Enhanced filters
        $priceRange = null;
        if ($request->has('price') && is_numeric($request->price)) {
            $priceRange = $this->calculatePriceRange($request->price);
        }

        $timeRange = null;
        if ($request->has('time') && $this->isTimeSearch($request->time)) {
            $timeRange = $this->calculateTimeRange($request->time);
        }

        $facilityTerms = [];
        if ($request->has('facility') && $this->isFacilitySearch($request->facility)) {
            $facilityTerms = $this->getFacilitySearchTerms($request->facility);
        }

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
            })
            ->when($selected_agent, function ($q, $a) {
                $q->whereHas('busTravel', function ($b) use ($a) {
                    $b->whereHas('busTravel', function ($b2) use ($a) {
                        $b2->where('business_name', 'like', $a);
                    });
                });
            })
            // Add price range filter
            ->when($priceRange, function ($q) use ($priceRange) {
                $q->whereBetween('price', [$priceRange['min'], $priceRange['max']]);
            })
            // Add time range filter
            ->when($timeRange, function ($q) use ($timeRange) {
                $q->whereTime('departure_time', '>=', $timeRange['start'])
                  ->whereTime('departure_time', '<=', $timeRange['end']);
            })
            // Add facility filter
            ->when(!empty($facilityTerms), function ($q) use ($facilityTerms) {
                $q->whereHas('busTravel', function ($b) use ($facilityTerms) {
                    foreach ($facilityTerms as $term) {
                        $b->where('facilities', 'like', '%' . $term . '%')
                          ->orWhere('description', 'like', '%' . $term . '%')
                          ->orWhere('class', 'like', '%' . $term . '%');
                    }
                });
            })
            ->get();

        $pulang = [];

        if ((int)$pp == 1) {
            $pulang = BusDeparture::with('busTravel', 'from', 'to')
                ->has('busTravel')
                ->whereHas('to', function ($f) use ($from) {
                    $f->where('name', 'like', $from);
                })
                ->whereHas('from', function ($t) use ($to) {
                    $t->where('name', 'like', $to);
                })
                ->when($selected_agent, function ($q, $a) {
                    $q->whereHas('busTravel', function ($b) use ($a) {
                        $b->whereHas('busTravel', function ($b2) use ($a) {
                            $b2->where('business_name', 'like', $a);
                        });
                    });
                })
                // Add price range filter for return trip
                ->when($priceRange, function ($q) use ($priceRange) {
                    $q->whereBetween('price', [$priceRange['min'], $priceRange['max']]);
                })
                // Add time range filter for return trip
                ->when($timeRange, function ($q) use ($timeRange) {
                    $q->whereTime('departure_time', '>=', $timeRange['start'])
                      ->whereTime('departure_time', '<=', $timeRange['end']);
                })
                // Add facility filter for return trip
                ->when(!empty($facilityTerms), function ($q) use ($facilityTerms) {
                    $q->whereHas('busTravel', function ($b) use ($facilityTerms) {
                        foreach ($facilityTerms as $term) {
                            $b->where('facilities', 'like', '%' . $term . '%')
                              ->orWhere('description', 'like', '%' . $term . '%')
                              ->orWhere('class', 'like', '%' . $term . '%');
                        }
                    });
                })
                ->get();
        }

        $newData['agent'] = BusTravels::Active()->get();
        $newData['selected_agent'] = $request->agent ?? null;
        $newData['selected_price_range'] = $request->price ?? null;
        $newData['selected_time_range'] = $request->time ?? null;
        $newData['selected_facility'] = $request->facility ?? null;

        $newData['is_pulang_pergi'] = $pp;
        $newData['kota_awal'] = $request->kota_awal;
        $newData['kota_tujuan'] = $request->kota_tujuan;
        $newData['date_pergi'] = $request->date_pergi;
        $newData['date_pulang'] = $request->date_pulang;
        $newData['jumlah_penumpang'] = $qty;
        $newData['pergi'] = $this->formatBus($pergi, $date);
        $newData['pulang'] = $this->formatBus($pulang, $date_pulang);
        $newData['city'] = BusRoute::get()->pluck('name', 'name');

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
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
            })
            ->when($selected_agent, function ($q, $a) {
                $q->whereHas('busTravel', function ($b) use ($a) {
                    $b->whereHas('busTravel', function ($b2) use ($a) {
                        $b2->where('business_name', 'like', $a);
                    });
                });
            })
            ->get();

        $pulang = [];

        if ((int)$pp == 1) {
            $pulang = BusDeparture::with('busTravel', 'from', 'to')
                ->has('busTravel')
                ->whereHas('to', function ($f) use ($from) {
                    $f->where('name', 'like', $from);
                })
                ->whereHas('from', function ($t) use ($to) {
                    $t->where('name', 'like', $to);
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
                'departure_point' => $val['from']['name'] ?? 'Deleted point',
                'departure_time' => Carbon::parse($val['departure_time'])->format('H:i'),
                'arrival_point' => $val['to']['name'] ?? 'Deleted point',
                'arrival_time' => Carbon::parse($val['departure_time'])->addHours($val['duration'] ?? 1)->format('H:i'),
                'price' => $val['price'],
                'duration' => $val['duration'],
                'avgRating' => $val->busTravel->avgRating(),
                'reviews' => $val->busTravel->reviews,
                'available_tickets' => $available,
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

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);
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
        for ($i = 1; $i < $request->jumlah_penumpang; $i++) {
            $data_kursi = [
                'id_costumer' => auth()->user()->id,
                'id_departure' => $request->ticket_pergi_id,
                'penumpang_ke' => $i,
                'is_pulang_pergi' => $request->is_pulang_pergi,
                'date_pergi' => $request->date_pergi,
                'date_pulang' => $request->date_pulang ? $request->date_pulang : null,
                'kursi_pergi' => $request->{"kursi_penumpang_$i"},
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

            $pulang = BusDeparture::with('busTravel', 'from', 'to')->find($data['ticket_pulang_id']);

            if (!$pulang) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Paket tiket pergi tidak ditemukan ',
                    ],
                    'Bus & Travel process failed',
                    500,
                );
            }

            $dateTimePulang = $data['date_pulang'] . ' ' . $pulang['departure_time'];

            $berangkatPulang =  Carbon::parse($dateTimePulang)->format('Y-m-d H:i');

            $total += $pulang['price'];
        } else {
            $berangkatPulang = null;
        }

        $data = $request->all();

        $pergi = BusDeparture::with('busTravel', 'from', 'to')->find($data['ticket_pergi_id']);
        $dateTimePergi = $data['date_pergi'] . ' ' . $pergi['departure_time'];

        $berangkat =  Carbon::parse($dateTimePergi)->format('Y-m-d H:i');

        $invoice = 'INV-' . date('Ymd') . '-' . strtoupper('bus_travel') . '-' . time();

        $service = Service::where('name', $data['service'])->first();

        if (!$service) {
            return ResponseFormatter::error([], 'Service not found', 500);
        }

        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $service['id'], $request->user()->id, $pergi->price);

        $kali = (int)$data['is_pulang_pergi'] == 1 ? 2 : 1;

        $total += $pergi['price'];


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

        $business = $pergi['busTravel']['busTravel']['business_name'] ?? 'Deleted business';

        $title = 'Pembelian ticket ' . $business . ((int)$data['is_pulang_pergi'] == 1 ? ' Pulang Pergi ' : ' ') . $pergi['from']['name'] . ' - ' . $pergi['to']['name'] . ' untuk tanggal ' . $berangkat;

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
        DB::transaction(function () use ($data, $berangkat, $berangkatPulang, $customer, $kode_unik, $invoice, $request, $payoutsXendit, $service, $amount, $fees, $pergi, $pulang, $saldoPointCustomer) {
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

                DetailTransactionBus::create([
                    "transaction_id" => $storeTransaction->id,
                    "bus_travel_id" => $pergi['busTravel']['busTravel']['id'],
                    "bus_travel_has_bus_id" => $pergi['busTravel']['id'],
                    "bus_departure_id" => $pergi['id'],
                    "booking_id" => $booking_id,
                    "departure_time" => $berangkat,
                    "from" => $pergi['from']['name'],
                    "to" => $pergi['to']['name'],
                    "price" => $pergi['price'],
                    "fee_admin" => $fees[0]['value'] / $data['jumlah_penumpang'],
                    "kode_unik" => $kode_unik,
                    "customer_name" => $request['customer_call_' . $i] . ' ' . $request['customer_name_' . $i] ?? '-',
                    "customer_phone" => $request['customer_phone_' . $i] ?? '-',
                    "customer_email" => $request['customer_email_' . $i] ?? '-',
                ]);

                if ((int)$data['is_pulang_pergi'] == 1) {
                    DetailTransactionBus::create([
                        "transaction_id" => $storeTransaction->id,
                        "bus_travel_id" => $pulang['busTravel']['busTravel']['id'],
                        "bus_travel_has_bus_id" => $pulang['busTravel']['id'],
                        "bus_departure_id" => $pulang['id'],
                        "booking_id" => $booking_id,
                        "departure_time" => $berangkatPulang,
                        "from" => $pulang['from']['name'],
                        "to" => $pulang['to']['name'],
                        "price" => $pulang['price'],
                        "fee_admin" => 0,
                        // "duration" => $data['duration'],
                        "kode_unik" => $kode_unik,
                        "customer_name" => $request['customer_call_' . $i] . ' ' . $request['customer_name_' . $i] ?? '-',
                        "customer_phone" => $request['customer_phone_' . $i] ?? '-',
                        "customer_email" => $request['customer_email_' . $i] ?? '-',
                    ]);
                }
            }
        });

        // return ResponseFormatter::success($hotel, 'Payment successfully created');
        // return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
        return redirect()->away($payoutsXendit['invoice_url']);
    }
}

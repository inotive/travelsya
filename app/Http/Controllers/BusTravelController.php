<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\BusBooked;
use App\Models\BusDeparture;
use App\Models\BusRoute;
use App\Models\BusTravels;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusTravelController extends Controller
{
    public function index(){
        $data['city'] = BusRoute::get()->pluck('name', 'name');

        $route = BusBooked::withCount('departure')->orderBy('departure_count', 'desc')->limit(12)->get();

        $data['route'] = $route->map(function($r){
            $r['from'] = $r->departure->from->name ?? '-';
            $r['to'] = $r->departure->to->name ?? '-';

            return $r;
        });

        $route_travel = BusBooked::withCount('departure')->orderBy('departure_count', 'desc')->limit(12)->get();

        $data['route_travel'] = $route_travel->map(function($r){
            $r['from'] = $r->departure->from->name ?? '-';
            $r['to'] = $r->departure->to->name ?? '-';

            return $r;
        });

        $data['popular'] = BusTravels::withCount('booked')->orderBy('booked_count', 'desc')->limit(8)->get();

        return view('pagesv2.bus_travel.index', $data);
    }

    public function search(Request $request, $agent = null){
        $from = '%' . $request->kota_awal . '%';
        $to = '%' . $request->kota_tujuan . '%';
        $date = $request->date_pergi;
        $date_pulang = $request->date_pulang;
        $qty = $request->jumlah_penumpang;
        $pp = $request->is_pulang_pergi;
        $selected_agent = $request->agent ? '%'.$request->agent.'%' : null;

        $pergi = BusDeparture::with('busTravel', 'from', 'to')
            ->has('busTravel')
            ->whereHas('from', function ($f) use ($from) {
                $f->where('name', 'like', $from);
            })
            ->whereHas('to', function ($t) use ($to) {
                $t->where('name', 'like', $to);
            })
            ->when($selected_agent, function($q, $a){
                $q->whereHas('busTravel', function($b) use($a){
                    $b->whereHas('busTravel', function($b2)use($a){
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
                ->when($selected_agent, function($q, $a){
                    $q->whereHas('busTravel', function($b) use($a){
                        $b->whereHas('busTravel', function($b2)use($a){
                            $b2->where('business_name', 'like', $a);
                        });
                    });
                })
                ->get();
        }

        $newData['agent'] = BusTravels::Active()->get();
        $newData['selected_agent'] = $request->agent ?? null;

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
            // 'available_tickets' => $collection['busTravel']['number_seats'] ?? 0,
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
                // 'available_tickets' => $val['busTravel']['number_seats'] ?? 0,
                'available_tickets' => $available,
            ];

            array_push($newTicket, $item);
        }

        return $newTicket;
    }

    public function detail(Request $request){
        $param = $request;

        $data['is_pulang_pergi'] = $param['is_pulang_pergi'];
        $data['departure_id'] = $param['departure_id'];
        $data['kota_awal'] = $param['kota_awal'];
        $data['kota_tujuan'] = $param['kota_tujuan'];
        $data['jumlah_penumpang'] = $param['jumlah_penumpang'];
        $data['date_pergi'] = $param['date_pergi'];
        $data['date_pulang'] = $param['date_pulang'];

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);

        return view('pagesv2.bus_travel.detail', $data);
    }

    public function order(Request $request){
        $user = auth()->user();

        if(!$user){
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

        $data['departure'] = BusDeparture::with('busTravel', 'from', 'to')->find($param['departure_id']);

        return view('pagesv2.bus_travel.order');
    }
}

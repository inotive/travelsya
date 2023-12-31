<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Transaction;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Services\Xendit;

class HostelController extends Controller
{
    protected $travelsya, $xendit;
    public function __construct(Travelsya $travelsya, Xendit $xendit)
    {
        $this->travelsya = $travelsya;
        $this->xendit = $xendit;
    }

    public function index(Request $request)
    {
        // $hostels = $this->travelsya->hostel(['location' => ($request->city) ?: '', 'name' => ($request->name) ?: '', 'category' => ($request->category) ?: '']);
        // $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
        // if ($request->name)
        //     $hostels->where('name', 'like', '%' . $request->name . '%');

        // if ($request->location)
        //     $hostels->where('city', 'like', '%' . $request->location . '%');

        // if ($request->category)
        //     $hostels->where('category', 'like', '%' . $request->category . '%');

        // if ($request->property)
        //     $hostels->where('property', $request->property);

        // if ($request->furnish) {
        //     $furnish = $request->furnish;
        //     $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
        //         $q->where('furnish', $furnish);
        //     });
        // }

        // if ($request->roomtype) {
        //     $roomtype = $request->roomtype;
        //     $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
        //         $q->where('roomtype', $roomtype);
        //     });
        // }

        // $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
        // }])->withCount(["rating as rating_avg" => function ($q) {
        //     $q->select(DB::raw('coalesce(avg(rate),0)'));
        // }])->withCount("rating as rating_count")->get();
        // // dd($hostelsget);
        // $cities = Hostel::distinct()->pluck('city');
        // $params = $request->all();
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->end);
        // $params['category'] = ($request->category) ?: '';
        // $params['name'] = ($request->name) ?: '';

        // return view('hostel.index', ['hostels' => $hostelsget, 'cities' => $cities, 'params' => $params]);

        $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating')
            ->where('city', 'like', '%' . $request->location . '%')
            ->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
            }])
            ->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])
            ->withCount("rating as rating_count");


        if ($request->has('harga')) {
            if ($request->harga == 'tertinggi') {
                $hostels->orderByDesc('price_avg');
            }

            if ($request->harga == 'terendah') {
                $hostels->orderBy('price_avg');
            }
        }

        if ($request->has('star')) {
            $hostels->where('star', $request->star);
        }


        $data['hostels'] = $hostels->get();
        $data['params']  = $request->all();
        $data['cities']  = Hostel::distinct()->select('city')->get();

        return view('hostel.index', $data);
    }

    public function room($id, Request $request)
    {
        // $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating');
        // $params['location'] = ($request->location) ?: '';
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->end);
        // $params['room'] = ($request->room) ?: '';
        // $params['guest'] = ($request->guest) ?: '';
        // $params['property'] = ($request->property) ?: '';
        // $params['roomtype'] = ($request->roomtype) ?: '';
        // $params['furnish'] = ($request->furnish) ?: '';
        // $params['name'] = ($request->name) ?: '';
        // $cities = Hostel::distinct()->pluck('city');

        // $hostelget = $hostel->withCount(["hostelRoom as price_avg" => function ($query) {
        //     $query->select(DB::raw('coalesce(avg(sellingprice),0)'));
        // }])
        //     ->withCount(["rating as rating_avg" => function ($query) {
        //         $query->select(DB::raw('coalesce(avg(rate),0)'));
        //     }])
        //     ->withCount("rating as rating_count")
        //     ->find($id);


        // $params['location'] = ($request->location) ?: '';
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = strtotime($request->end);
        // $params['duration'] = ($request->duration) ?: '';
        // $params['room'] = ($request->room) ?: '';
        // $params['guest'] = ($request->guest) ?: '';
        // $params['property'] = ($request->property) ?: '';
        // $params['roomtype'] = ($request->roomtype) ?: '';
        // $params['furnish'] = ($request->furnish) ?: '';
        // $params['name'] = ($request->name) ?: '';

        // return view('hostel.room', compact('hostelget', 'params', 'cities'));

        $hostel = Hostel::with('hostelRoom', 'hostelImage', 'rating');

        $data['hostelget'] = $hostel->withCount(["hostelRoom as price_avg" => function ($query) {
            $query->select(DB::raw('coalesce(avg(sellingprice),0)'));
        }])
            ->withCount(["rating as rating_avg" => function ($query) {
                $query->select(DB::raw('coalesce(avg(rate),0)'));
            }])
            ->withCount("rating as rating_count")
            ->find($id);

        $data['params'] = $request->all();

        // dd($request->all());
        $data['cities'] = Hostel::distinct()->select('city')->get();

        return view('hostel.room', $data);
    }

    public function checkout($id, Request $request)
    {
        // $hostelRoom = HostelRoom::with('hostel', 'bookDate')->find($id);
        // $params['start_date'] = strtotime($request->start);
        // $params['end_date'] = ($request->room) ?: '';
        // $params['guest'] = ($request->guest) ?: '';
        // $params['duration'] =  date('d-m-Y', strtotime("+" . $request->duration . " month", strtotime($request->start)));
        // $params['room'] = ($request->duration) ?: '';
        // $params['duration'] = ($request->duration) ?: '';
        // return view('hostel.checkout', compact('hostelRoom', 'params'));

        $data['params'] = $request->all();
        $data['hostelRoom'] = HostelRoom::with('hostel')->findOrFail($id);
        $point = new Point;
        $data['point'] = $point->cekPoint(auth()->user()->id);

        return view('hostel.checkout', $data);
    }

    public function request(Request $request)
    {
        // $data = $request->all();

        // $hostel = $this->travelsya->requestHostel([
        //     "service" => $data['service'],
        //     "payment" => $data['payment_method'],
        //     "hostel_room_id" => $data['hostel_room_id'],
        //     "point" => 0,
        //     "guest" => [[
        //         "type_id" => "KTP",
        //         "identity" => 123456,
        //         "name" => $data['name']
        //     ]],
        //     "start" => $data['start'],
        //     "end" => $data['end'],
        //     "url" => "linkproduct"

        // ]);

        // dd($hostel);

        // return redirect()->to($hostel['data']['invoice_url'])->send();

        $data = $request->all();

        // dd($data);
        $hostel = HostelRoom::with('hostel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($hostel->hostel->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $hostel->hostel->service_id, $request->user()->id, $hostel->sellingprice);
        // dd($fees);

        if (!$fees) return 'Point invalid';
        // $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days);
        $qty = $data['duration'];
        if ($qty < 0) return 'Date must be forward';
        $amount = $setting->getAmount($hostel->sellingprice, $qty, $fees, $data['room']);
        // $amount = $data['grand_total'];

        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hostel_room_id'],
                    "name" => $hostel['name'],
                    "price" => $hostel->sellingprice,
                    "quantity" => $qty,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url'  => route('user.profile'),
            'failure_redirect_url' => route('user.profile'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: "somenumber",
            ],
            'fees' => $fees
        ]);

        // dd($payoutsXendit);

        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hostel) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'req_id' => 'HTL-' . time(),
                'service' => $hostel->hostel->service->name,
                'service_id' => $hostel->hostel->service_id,
                // 'payment' => $payoutsXendit['payment'],
                'payment' => 'xendit',
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
                'total' => $amount
            ]);

            if ($data['point']) {
                //deductpoint
                $point = new Point;
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $storeTransaction->id);
            }
        });

        return redirect($payoutsXendit['invoice_url']);
    }

    public function ajaxHostel(Request $request)
    {
        try {
            $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
            if ($request->name)
                $hostels->where('name', 'like', '%' . $request->name . '%');

            if ($request->city)
                $hostels->where('city', $request->city);

            if ($request->category)
                $hostels->where('category', 'like', '%' . $request->category . '%');

            if ($request->property)
                $hostels->where('property', $request->property);

            if ($request->furnish) {
                $furnish = $request->furnish;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($furnish) {
                    $q->where('furnish', $furnish);
                });
            }

            if ($request->roomtype) {
                $roomtype = $request->roomtype;
                $hostels->withWhereHas('hostelRoom', function ($q) use ($roomtype) {
                    $q->where('roomtype', $roomtype);
                });
            }
            $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(sellingprice),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")->get();

            $hostelsCollect = collect($hostelsget);
            if ($request->optionsort == 'highestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'desc']])->values();

            if ($request->optionsort == 'lowestprice')
                $hotstelFIlter = $hostelsCollect->sortBy([['price_avg', 'asc']])->values();

            if ($request->optionsort == 'review')
                $hotstelFIlter = $hostelsCollect->sortBy([['rating_avg', 'desc']])->values();

            if ($request->optionrate  != null) {
                for ($i = 1; $i < 6; $i++) {
                    if ($request->optionrate == $i) {
                        $rate = $request->optionrate;
                        $hotstelFIlter = $hostelsCollect->filter(function ($values) use ($rate) {
                            return ceil($values['rating_avg']) == ceil($rate);
                        });
                    }
                }
            }

            return response()->json($hotstelFIlter->all());


            // return response()->json($pulsa);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function ajaxCity()
    {
        $hostelCity = Hostel::distinct()->select('city')->get();

        return response()->json(($hostelCity));
    }
}

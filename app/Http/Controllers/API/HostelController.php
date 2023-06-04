<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequestUpdate;
use App\Models\BookDate;
use App\Models\DetailTransaction;
use App\Models\Guest;
use App\Models\Hostel;
use App\Models\HostelImage;
use App\Models\HostelRoom;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Point;
use App\Services\Setting;
use App\Services\Xendit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class HostelController extends Controller
{
    protected $xendit, $point;
    public function __construct(Xendit $xendit, Point $point)
    {
        $this->xendit =  $xendit;
        $this->point =  $point;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $hostels = Hostel::with('hostelRoom', 'hostelImage', 'rating');
            if ($request->name)
                $hostels->where('name', 'like', '%' . $request->name . '%');

            if ($request->location)
                $hostels->where('city', 'like', '%' . $request->location . '%');

            if ($request->category)
                $hostels->where('category', 'like', '%' . $request->category . '%');

            $hostelsget = $hostels->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(price),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")->get();

            if (count($hostelsget)) {
                return ResponseFormatter::success($hostelsget, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (Exception $th) {
            return ResponseFormatter::error([
                $th->getMessage(),
                'message' => 'Something wrong',
            ], 'Hostel process failed', 500);
        }
    }

    public function requestTransaction(Request $request)
    {
        // handle validation
        $validator = Validator::make($request->all(), [
            "service" => "required|string",
            "payment" => "required|string",
            "point" => "required",
            "hostel_room_id" => "required",
            "guest" => "required",
            "start" => "required",
            "end" => "required",

        ]);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'Hostel process failed', 500);
        }

        $data = $request->all();
        $hostel = HostelRoom::with('hostel.service')->find($data['hostel_room_id']);
        $invoice = "INV-" . date('Ymd') . "-" . strtoupper($hostel->hostel->service->name) . "-" . time();
        $setting = new Setting();
        $fees = $setting->getFees($data['point'], $hostel->hostel->service_id, $request->user()->id, $hostel->price);

        //cekpoint 
        if (!$fees) return ResponseFormatter::error(null, 'Point invalid');
        $amount = $setting->getAmount($hostel->price, 1, $fees);
        $qty = (date_diff(date_create($data['start']), date_create($data['end']))->days) ?: 1;

        // cek book date
        $checkBook = BookDate::where("hostel_room_id", $data['hostel_room_id'])->where('start', '>=', $data['start'])->where('end', "<=", $data['end'])->first();
        if ($checkBook) {
            return ResponseFormatter::error($checkBook, 'Book dates is not available');
        }

        // ceate xendit
        $payoutsXendit = $this->xendit->create([
            'external_id' => $invoice,
            'items' => [
                [
                    "product_id" => $data['hostel_room_id'],
                    "name" => $hostel['name'],
                    "price" => $hostel->price,
                    "quantity" => $qty,
                ]
            ],
            'amount' => $amount,
            'success_redirect_url'  => route('redirect.succes'),
            'failure_redirect_url' => route('redirect.fail'),
            'invoice_duration ' => 72000,
            'should_send_email' => true,
            'customer' => [
                'given_names' => $request->user()->name,
                'email' => $request->user()->email,
                'mobile_number' => $request->user()->phone ?: "somenumber",
            ],
            'fees' => $fees
        ]);

        // true buat trans
        DB::transaction(function () use ($data, $invoice, $request, $payoutsXendit, $qty, $amount, $fees, $hostel) {

            $storeTransaction = Transaction::create([
                'no_inv' => $invoice,
                'service' => $hostel->hostel->service->name,
                'service_id' => $hostel->hostel->service_id,
                'payment' => $data['payment'],
                'user_id' => $request->user()->id,
                'status' => $payoutsXendit['status'],
                'link' => $payoutsXendit['invoice_url'],
            ]);


            // true buat detail
            $storeDetailTransaction = DetailTransaction::create([
                'transaction_id' => $storeTransaction->id,
                'hostel_room_id' => $data['hostel_room_id'],
                "qty" => $qty,
                "price" => $amount
            ]);


            // true buat bookdate
            $storeBookDate = BookDate::create([
                'start' => $data['start'],
                'end' => $data['end'],
                'hostel_room_id' => $data["hostel_room_id"],
                'transaction_id' => $storeTransaction->id
            ]);

            // true buat guest
            foreach ($data['guest'] as $guest) {
                $storeGuest = Guest::create([
                    'transaction_id' => $storeTransaction->id,
                    'type_id' => $guest['type_id'],
                    'identity' => $guest['identity'],
                    'name' => $guest['name'],
                ]);
            }
            if ($data['point']) {
                //deductpoint
                $point = new Point;
                $point->deductPoint($request->user()->id, abs($fees[1]['value']), $storeTransaction->id);
            }
        });


        return ResponseFormatter::success($payoutsXendit, 'Payment successfully created');
    }

    public function hostelCity()
    {
        $hostelCity = Hostel::distinct()->pluck('city');

        if (!$hostelCity)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hostelCity, 'Data successfully loaded');
    }

    public function hostelPopuler()
    {
        $hostelPopuler = Hostel::with('hostelImage', 'rating')
            ->withCount(["hostelRoom as price_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(price),0)'));
            }])->withCount(["rating as rating_avg" => function ($q) {
                $q->select(DB::raw('coalesce(avg(rate),0)'));
            }])->withCount("rating as rating_count")
            ->orderBy('rating_count', 'DESC')
            ->orderBy('rating_avg', 'DESC')
            ->orderBy('price_avg', "desc")->get();

        if (!$hostelPopuler)
            return ResponseFormatter::error(null, 'Data not found');

        return ResponseFormatter::success($hostelPopuler, 'Data successfully loaded');
    }
}

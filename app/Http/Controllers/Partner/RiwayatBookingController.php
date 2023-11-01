<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\Hostel;
use App\Models\HotelBookDate;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // public function index(Request $request)
    // {
    //     $id = auth()->user()->id;
    //     $tr = Transaction::with('user', 'detailTransaction.hostelRoom.hostel', 'bookDate')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
    //         $q->where('user_id', $id);
    //     })->where('service', 'hostel');

    //     if ($request->hotel != null) {
    //         $hotel = $request->hotel;
    //         $tr = $tr->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($hotel) {
    //             $q->where('id', $hotel);
    //         });
    //     }

    //     if ($request->start != null) {
    //         $start = date($request->start);
    //         $end = date($request->end);
    //         $tr = $tr->withWhereHas('bookDate', function ($q) use ($start, $end) {
    //             $q->whereDate('start', '>=', date($start))->whereDate('end', '<=', date($end));
    //         });
    //     }
    //     $transactions = $tr->orderBy('created_at', 'desc')->paginate(10);
    //     $hostels = Hostel::where('user_id', $id)->select('name', 'id')->get();
    //     // dd($hostels);
    //     return view('ekstranet.booking.index', compact('transactions', 'hostels'));
    // }

    public function index(Request $request)
    {
        
        $hotelbookdates = DetailTransactionHotel::query()->with('hotelRoom', 'Hotel')->whereHas('Hotel', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });
        $hostelbookdates = DetailTransactionHostel::query()->with('hostelRoom', 'Hostel')->whereHas('Hostel', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });


        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');


        if ($year != null) {
            $hotelbookdates->whereYear('reservation_start', $year)->orWhereYear('reservation_end', $year);
            $hostelbookdates->whereYear('reservation_start', $year)->orWhereYear('reservation_end', $year);
        }

        if ($start != null) {
            $hotelbookdates = $hotelbookdates->where('reservation_start', '>=', $start);
            $hostelbookdates = $hostelbookdates->where('reservation_start', '>=', $start);
        }

        if ($end != null) {
            $hotelbookdates = $hotelbookdates->where('reservation_end', '<=', $end);
            $hostelbookdates = $hostelbookdates->where('reservation_end', '<=', $end);
        }

        $hotelbookdates = $hotelbookdates->get();
        $hostelbookdates = $hostelbookdates->get();

        return view('ekstranet.booking.index', compact('hotelbookdates', 'hostelbookdates'));
    }

    public function detailhotelbookdate($id)
    {
        $hotelbookdates = DetailTransactionHotel::with('transaction')->findOrFail($id);

        return view('ekstranet.booking.detail-book-hotel', compact('hotelbookdates'));
    }

    public function detailhostelbookdate($id)
    {
        // $hostelbookdates = BookDate::find($id);
        $hostelbookdates = DetailTransactionHostel::with('transaction')->findOrFail($id);


        return view('ekstranet.booking.detail-book-hostel', compact('hostelbookdates'));
    }

    // public function detailroomhostel($id)
    // {


    //     return view('ekstranet.management-room.detail-room-hostel', compact('hostelrooms'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

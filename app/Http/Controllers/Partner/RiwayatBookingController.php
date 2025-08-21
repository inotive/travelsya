<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\detailTransactionRecreation;
use App\Models\DetailTransactionBus;
use App\Models\DetailTransactionCarRental;
use App\Models\Hostel;
use App\Models\HotelBookDate;
use App\Models\Recreation;
use App\Models\BusBooked;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        $hotelbookdates = DetailTransactionHotel::with('hotelRoom', 'hotel','transaction')
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
        ->whereHas('hotel', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        });

    $hostelbookdates = DetailTransactionHostel::with('hostelRoom', 'hostel','transaction')
        ->whereHas('transaction', function ($q) {
            $q->where('status', 'PAID');
        })
        ->whereHas('hostel', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
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
        $hostelbookdates = DetailTransactionHostel::with('transaction')->findOrFail($id);

        return view('ekstranet.booking.detail-book-hostel', compact('hostelbookdates'));
    }

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

    public function cetakHotel(DetailTransactionHotel $hotel)
    {
        $data = [
            'data' => $hotel->load('hotel.hotelroomFacility.facility', 'hotelRoom.hotelRoomFacility.facility', 'transaction.user')
        ];
        return view('user.order-detail.e-tiket', $data);
    }

    public function cetakHostel($id)
    {
        $hostel = DetailTransactionHostel::findorFail($id);
        $data = [
            'data' => $hostel->load('hostel.hostelFacilities.facility', 'hostelRoom.hostelFacilities.facility', 'transaction.user')
        ];
        return view('user.order-detail.e-tiket-hostel', $data);
    }

    public function indexRekreasi(Request $request)
    {
        $user_id = auth()->user()->id;

        $rekreasibookdates = detailTransactionRecreation::with('recreation', 'transaction')
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
            ->whereHas('recreation', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');

        if ($year != null) {
            $rekreasibookdates->whereYear('book_date', $year);
        }

        if ($start != null) {
            $rekreasibookdates = $rekreasibookdates->where('book_date', '>=', $start);
        }

        if ($end != null) {
            $rekreasibookdates = $rekreasibookdates->where('expire_on', '<=', $end);
        }

        $rekreasibookdates = $rekreasibookdates->get();

        return view('ekstranet.booking.rekreasi', compact('rekreasibookdates'));
    }

    public function verifikasiRekreasi($id)
    {
        $booking = detailTransactionRecreation::findOrFail($id);
        $booking->status = 'verified';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil diverifikasi');
    }

    public function batalVerifikasiRekreasi($id)
    {
        $booking = detailTransactionRecreation::findOrFail($id);
        $booking->status = 'pending';
        $booking->save();

        return redirect()->back()->with('success', 'Verifikasi booking dibatalkan');
    }

    // Car Rental Methods
    public function indexCarRental(Request $request)
    {
        $user_id = auth()->user()->id;

        $carrentalbookdates = DetailTransactionCarRental::with('carRental', 'car.brand', 'car.carModel', 'transaction')
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
            ->whereHas('carRental', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');

        if ($year != null) {
            $carrentalbookdates->whereYear('start', $year)->orWhereYear('end', $year);
        }

        if ($start != null) {
            $carrentalbookdates = $carrentalbookdates->where('start', '>=', $start);
        }

        if ($end != null) {
            $carrentalbookdates = $carrentalbookdates->where('end', '<=', $end);
        }

        $carrentalbookdates = $carrentalbookdates->get();

        return view('ekstranet.booking.daftar-kendaraan', compact('carrentalbookdates'));
    }

    public function verifikasiCarRental($id)
    {
        $booking = DetailTransactionCarRental::findOrFail($id);
        $booking->status = 'verified';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil diverifikasi');
    }

    public function batalVerifikasiCarRental($id)
    {
        $booking = DetailTransactionCarRental::findOrFail($id);
        $booking->status = 'pending';
        $booking->save();

        return redirect()->back()->with('success', 'Verifikasi booking dibatalkan');
    }

    public function indexBus(Request $request)
    {
        $query = DetailTransactionBus::with(['transaction.user', 'busTravel', 'busTravelHasBus', 'departure'])
            ->whereHas('transaction', function ($q) {
                $q->whereHas('user', function ($userQuery) {
                    $userQuery->where('id', auth()->id());
                });
            });

        // Filter by year if provided
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter by date range if provided
        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        $busbookings = $query->orderBy('created_at', 'desc')->get();

        return view('ekstranet.booking.bus-travel', compact('busbookings'));
    }

    /**
     * Verify bus booking
     */
    public function verifikasiBus($id)
    {
        try {
            $busBooking = DetailTransactionBus::with('transaction')->findOrFail($id);

            // Check if user has permission to verify this booking
            if ($busBooking->transaction->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk verifikasi booking ini.');
            }

            // Update transaction status to verified
            $busBooking->transaction->update([
                'status' => 'verified'
            ]);

            return redirect()->back()->with('success', 'Booking bus travel berhasil diverifikasi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Cancel verification of bus booking
     */
    public function batalVerifikasiBus($id)
    {
        try {
            $busBooking = DetailTransactionBus::with('transaction')->findOrFail($id);

            // Check if user has permission to cancel verification
            if ($busBooking->transaction->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan verifikasi booking ini.');
            }

            // Update transaction status to pending
            $busBooking->transaction->update([
                'status' => 'pending'
            ]);

            return redirect()->back()->with('success', 'Verifikasi booking bus travel berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}



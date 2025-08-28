<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\detailTransactionRecreation;
use App\Models\DetailTransactionCarRental;
use App\Models\Hostel;
use App\Models\HotelBookDate;
use App\Models\Recreation;
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

    public function cetakCarRental($id)
    {
        $carRentalBooking = DetailTransactionCarRental::findOrFail($id);
        $data = [
            'data' => $carRentalBooking->load('carRental', 'car.brand', 'car.carModel', 'transaction.user')
        ];
        return view('user.order-detail.e-tiket-car-rental', $data); // Assuming a new blade for car rental invoice
    }

    public function cetakRekreasi($id)
    {
        $recreationBooking = detailTransactionRecreation::findOrFail($id);
        $data = [
            'data' => $recreationBooking->load('recreation', 'package', 'transaction.user')
        ];
        return view('user.order-detail.e-tiket-recreation', $data); // Assuming a new blade for recreation invoice
    }

    public function indexRekreasi(Request $request)
    {
        $user_id = auth()->user()->id;

        $rekreasibookdates = detailTransactionRecreation::with('recreation', 'transaction.user', 'package')
            ->whereHas('recreation', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            });

        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');
        $keyword = $request->input('keyword');

        if ($year) {
            $rekreasibookdates->whereHas('transaction', function ($q) use ($year) {
                $q->whereYear('created_at', $year);
            });
        }

        if ($start) {
            $rekreasibookdates->whereHas('transaction', function ($q) use ($start) {
                $q->whereDate('created_at', '>=', $start);
            });
        }

        if ($end) {
            $rekreasibookdates->whereHas('transaction', function ($q) use ($end) {
                $q->whereDate('created_at', '<=', $end);
            });
        }

        if ($keyword) {
            $rekreasibookdates->where(function ($query) use ($keyword) {
                $query->where('booking_id', 'like', '%' . $keyword . '%')
                    ->orWhereHas('transaction.user', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('package', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $rekreasibookdates = $rekreasibookdates->get();

        return view('ekstranet.booking.rekreasi', compact('rekreasibookdates'));
    }

    public function verifikasiRekreasi($id)
    {
        $booking = detailTransactionRecreation::findOrFail($id);
        $booking->is_used = true;
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil diverifikasi');
    }

    public function batalVerifikasiRekreasi($id)
    {
        $booking = detailTransactionRecreation::findOrFail($id);
        $booking->is_used = false;
        $booking->save();

        return redirect()->back()->with('success', 'Verifikasi booking dibatalkan');
    }

    // Car Rental Methods
    public function indexCarRental(Request $request)
    {
        $user_id = auth()->user()->id;

        $carrentalbookdates = DetailTransactionCarRental::with('carRental', 'car.brand', 'car.carModel', 'transaction.user')
            ->whereHas('carRental', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            });

        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');
        $keyword = $request->input('keyword');

        if ($year) {
            $carrentalbookdates->whereHas('transaction', function ($q) use ($year) {
                $q->whereYear('created_at', $year);
            });
        }

        if ($start) {
            $carrentalbookdates->whereHas('transaction', function ($q) use ($start) {
                $q->whereDate('created_at', '>=', $start);
            });
        }

        if ($end) {
            $carrentalbookdates->whereHas('transaction', function ($q) use ($end) {
                $q->whereDate('created_at', '<=', $end);
            });
        }

        if ($keyword) {
            $carrentalbookdates->where(function ($query) use ($keyword) {
                $query->where('booking_id', 'like', '%' . $keyword . '%')
                    ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                    ->orWhereHas('transaction.user', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
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
}
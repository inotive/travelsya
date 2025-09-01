<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\DetailTransactionHealthBeauty; // ✅ taruh di sini
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

        $hotelbookdates = DetailTransactionHotel::with('hotelRoom', 'hotel', 'transaction')
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
            ->whereHas('hotel', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

        $hostelbookdates = DetailTransactionHostel::with('hostelRoom', 'hostel', 'transaction')
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


    public function healthBeauty(Request $request)
    {
        $user_id = auth()->user()->id;

        $query = DetailTransactionHealthBeauty::with(['transaction.user', 'package'])
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
            ->whereHas('clinic', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });

        // Filter tahun berdasarkan created_at
        if ($request->year) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter tanggal
        if ($request->start) {
            $query->whereDate('created_at', '>=', $request->start);
        }

        if ($request->end) {
            $query->whereDate('created_at', '<=', $request->end);
        }

        // Filter status tab
        $now = now();
        $tab = $request->tab ?? 'all';

        if ($tab !== 'all') {
            switch ($tab) {
                case 'unused':
                    $query->where('expire_on', '>', $now)->where('is_used', false);
                    break;
                case 'used':
                    $query->where('is_used', true);
                    break;
                case 'expired':
                    $query->where('expire_on', '<=', $now)->where('is_used', false);
                    break;
            }
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('ekstranet.booking.health-beauty', compact('transactions'));
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

    public function indexBus(Request $request)
    {
        $user_id = auth()->user()->id;

        $busbookings = DetailTransactionBus::with('busTravel', 'busTravelHasBus', 'departure', 'transaction')
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'PAID');
            })
            ->whereHas('busTravel', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

        $year = $request->input('year');
        $start = $request->input('start');
        $end = $request->input('end');
        $keyword = $request->input('keyword');

        if ($year != null) {
            $busbookings->whereYear('departure_time', $year);
        }

        if ($start != null) {
            $busbookings = $busbookings->where('departure_time', '>=', $start);
        }

        if ($end != null) {
            $busbookings = $busbookings->where('departure_time', '<=', $end);
        }

        if ($keyword) {
            $busbookings->where(function ($query) use ($keyword) {
                $query->where('booking_id', 'like', '%' . $keyword . '%')
                    ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                    ->orWhere('customer_phone', 'like', '%' . $keyword . '%')
                    ->orWhereHas('transaction.user', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%')
                          ->orWhere('phone', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('busTravel', function ($q) use ($keyword) {
                        $q->where('business_name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $busbookings = $busbookings->get();

        return view('ekstranet.booking.bus-travel', compact('busbookings'));
    }

    public function verifikasiBus($id)
    {
        $booking = DetailTransactionBus::findOrFail($id);
        $booking->status = 'verified';
        $booking->save();

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

    public function batalVerifikasiBus($id)
    {
        $booking = DetailTransactionBus::findOrFail($id);
        $booking->status = 'pending';
        $booking->save();

        return redirect()->back()->with('success', 'Verifikasi booking dibatalkan');
    }

    public function cetakBus($id, Request $request)
    {
        $busBooking = DetailTransactionBus::findOrFail($id);
        $data = [
            'data' => $busBooking->load('busTravel', 'busTravelHasBus', 'departure', 'transaction.user')
        ];

            return redirect()->back()->with('success', 'Verifikasi booking bus travel berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // For modal display, return partial view without full HTML structure
        if ($request->ajax() || $request->expectsJson()) {
            return view('user.order-detail.e-tiket-bus-modal', $data);
        }

        // Regular view for direct access
        return view('user.order-detail.e-tiket-bus', $data);
    }
}

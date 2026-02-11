<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\DetailTransactionBus;
use App\Models\DetailTransactionCarRental;
use App\Models\DetailTransactionHealthBeauty;
use App\Models\DetailTransactionRecreation;
use Illuminate\Http\Request;
use DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        /**
         * VARIABEL ======================================
         */
        $id = auth()->user()->id;
        $year = $request->year;
        $start = $request->start;
        $end = $request->end;
        $business = $request->business;

        $transaction_hotel = [];
        if ($business == null || $business == 'all' || $business == 'hotel') {
            $transaction_hotel = DetailTransactionHotel::with('transaction', 'hotel')
                ->whereHas('transaction', function ($query) use ($year,$start,$end){
                    $query->where('status', 'PAID');
                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }

                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }

                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59'; // Akhiri hari ini
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('hotel', function ($query) use ($id){
                    $query->where('user_id',$id);
                })->orderByDesc('updated_at')
                ->get();
        }

        $transaction_hostel = [];
        if ($business == null || $business == 'all' || $business == 'hostel') {
            $transaction_hostel = DetailTransactionHostel::with('transaction','hostel')
                ->whereHas('transaction', function ($query) use ( $year, $start, $end) {
                    $query->where('status', 'PAID');

                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }
                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }

                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59'; // Akhiri hari ini
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('hostel', function ($query) use ($id){
                    $query->where('user_id',$id);
                })->orderByDesc('updated_at')
                ->get();
        }

        $transaction_buses = [];
        if ($business == null || $business == 'all' || $business == 'bus') {
            $transaction_buses = DetailTransactionBus::with('transaction', 'busTravel')
                ->whereHas('transaction', function ($query) use ($year, $start, $end) {
                    $query->where('status', 'PAID');
                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }
                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }
                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59';
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('busTravel', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->orderByDesc('updated_at')
                ->get();
        }

        $transaction_rentals = [];
        if ($business == null || $business == 'all' || $business == 'rental') {
            $transaction_rentals = DetailTransactionCarRental::with('transaction', 'carRental')
                ->whereHas('transaction', function ($query) use ($year, $start, $end) {
                    $query->where('status', 'PAID');
                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }
                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }
                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59';
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('carRental', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->orderByDesc('updated_at')
                ->get();
        }

        $transaction_clinics = [];
        if ($business == null || $business == 'all' || $business == 'clinic') {
            $transaction_clinics = DetailTransactionHealthBeauty::with('transaction', 'clinic')
                ->whereHas('transaction', function ($query) use ($year, $start, $end) {
                    $query->where('status', 'PAID');
                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }
                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }
                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59';
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('clinic', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->orderByDesc('updated_at')
                ->get();
        }

        $transaction_recreations = [];
        if ($business == null || $business == 'all' || $business == 'recreation') {
            $transaction_recreations = DetailTransactionRecreation::with('transaction', 'recreation')
                ->whereHas('transaction', function ($query) use ($year, $start, $end) {
                    $query->where('status', 'PAID');
                    if ($year != null) {
                        $query->whereYear('created_at', $year);
                    }
                    if ($start != null) {
                        $startDateTime = $start . ' 00:00:00';
                        $query->where('created_at', '>=', $startDateTime);
                    }
                    if ($end != null) {
                        $endDateTime = $end . ' 23:59:59';
                        $query->where('created_at', '<=', $endDateTime);
                    }
                })
                ->whereHas('recreation', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->orderByDesc('updated_at')
                ->get();
        }


        // Calculate totals
        $total_rent_price = 0;
        $total_fee_admin = 0;
        $total_point_discount = 0;
        $grand_total = 0;

        // Calculate hotel totals
        foreach ($transaction_hotel as $hotel) {
            $total_rent_price += $hotel->rent_price;
            $total_fee_admin += $hotel->fee_admin;
            $grand_total += ($hotel->rent_price + $hotel->fee_admin);
        }

        // Calculate hostel totals
        foreach ($transaction_hostel as $hostel) {
            $total_rent_price += $hostel->rent_price;
            $total_fee_admin += $hostel->fee_admin;
            $grand_total += ($hostel->rent_price + $hostel->fee_admin);
        }

        // Calculate bus totals
        foreach ($transaction_buses as $bus) {
            $total_rent_price += $bus->price; // Note: Bus uses 'price' not 'rent_price'
            $total_fee_admin += $bus->fee_admin;
            $grand_total += ($bus->price + $bus->fee_admin);
        }

        // Calculate rental totals
        foreach ($transaction_rentals as $rental) {
            $total_rent_price += $rental->rent_price;
            $total_fee_admin += $rental->fee_admin;
            $grand_total += ($rental->rent_price + $rental->fee_admin);
        }

        // Calculate clinic totals
        foreach ($transaction_clinics as $clinic) {
            $total_rent_price += $clinic->rent_price;
            $total_fee_admin += $clinic->fee_admin;
            $grand_total += ($clinic->rent_price + $clinic->fee_admin);
        }

        // Calculate recreation totals
        foreach ($transaction_recreations as $recreation) {
            $total_rent_price += $recreation->rent_price;
            $total_fee_admin += $recreation->fee_admin;
            $grand_total += ($recreation->rent_price + $recreation->fee_admin);
        }

        $data['transaction_hotels'] = $transaction_hotel;
        $data['transaction_hostels'] = $transaction_hostel;
        $data['transaction_buses'] = $transaction_buses;
        $data['transaction_rentals'] = $transaction_rentals;
        $data['transaction_clinics'] = $transaction_clinics;
        $data['transaction_recreations'] = $transaction_recreations;

        $data['total_rent_price'] = $total_rent_price;
        $data['total_fee_admin'] = $total_fee_admin;
        $data['total_point_discount'] = $total_point_discount;
        $data['grand_total'] = $grand_total;

        return view('ekstranet.laporan.semua', $data);
    }
}

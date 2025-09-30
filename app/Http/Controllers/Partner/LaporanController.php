<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
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


        // Calculate totals
        $total_rent_price = 0;
        $total_fee_admin = 0;
        $total_point_discount = 0;
        $grand_total = 0;

        // Calculate hotel totals
        foreach ($transaction_hotel as $hotel) {
            $total_rent_price += $hotel->rent_price;
            $total_fee_admin += $hotel->fee_admin;
            // Assuming point discount is calculated from transaction or can be added later
            $grand_total += ($hotel->rent_price + $hotel->fee_admin);
        }

        // Calculate hostel totals
        foreach ($transaction_hostel as $hostel) {
            $total_rent_price += $hostel->rent_price;
            $total_fee_admin += $hostel->fee_admin;
            // Assuming point discount is calculated from transaction or can be added later
            $grand_total += ($hostel->rent_price + $hostel->fee_admin);
        }

        $data['transaction_hotels'] = $transaction_hotel;
        $data['transaction_hostels'] = $transaction_hostel;
        $data['total_rent_price'] = $total_rent_price;
        $data['total_fee_admin'] = $total_fee_admin;
        $data['total_point_discount'] = $total_point_discount;
        $data['grand_total'] = $grand_total;

        return view('ekstranet.laporan.semua', $data);
    }
}

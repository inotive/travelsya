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


        $data['transaction_hotels'] = $transaction_hotel;
        $data['transaction_hostels'] = $transaction_hostel;


        return view('ekstranet.laporan.semua', $data);
    }
}

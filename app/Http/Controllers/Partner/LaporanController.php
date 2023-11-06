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

        $transaction_hotel = DetailTransactionHotel::with('transaction')
            ->whereHas('transaction', function ($query) use ($id, $year, $start, $end) {
                $query->where('user_id', $id);

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
            })->get();

        $transaction_hostel = DetailTransactionHostel::with('transaction')
            ->whereHas('transaction', function ($query) use ($id, $year, $start, $end) {
                $query->where('user_id', $id);

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
            })->get();


        $data['transaction_hotels'] = $transaction_hotel;
        $data['transaction_hostels'] = $transaction_hostel;


        return view('ekstranet.laporan.semua', $data);
    }
}

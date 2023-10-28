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

        /**
         * DAFTAR TRANSAKSI HOTEL DAN HOSTEL ======================================
         */
        $transaction_hotel = DetailTransactionHotel::withWhereHas('transaction', function ($query) use ($id) {
            $query->where('user_id', $id);
        });

        $transaction_hostel = DetailTransactionHostel::withWhereHas('transaction', function ($query) use ($id) {
            $query->where('user_id', $id);
        });


        /**
         * MULTIPLE FILTER LAPORAN ======================================
         */
        if ($request->year != '') {
            $transaction_hotel->whereYear('created_at', $request->year);
            $transaction_hostel->whereYear('created_at', $request->year);
        }

        if ($request->start != '') {
            $transaction_hotel->where('created_at', '>=', $request->start . ' 00:00:00');
            $transaction_hostel->where('created_at', '>=', $request->start . ' 00:00:00');
        }

        if ($request->end != '') {
            $transaction_hotel->where('created_at', '<=', $request->end . ' 00:00:00');
            $transaction_hostel->where('created_at', '<=', $request->end . ' 00:00:00');
        }

        $data['transaction_hotels'] = $transaction_hotel->get();
        $data['transaction_hostels'] = $transaction_hostel->get();

        // $transcation_id = $data['transaction_hostels']->first()->transcation_id;

        
        // $detail_pemesanan = DB::table('book_dates')
        //     ->join('transactions', 'transactions.id', '=', 'book_dates.transaction_id')
        //     ->where('transaction_id', $transcation_id)
        //     ->value('book_dates.id');
        // dd($transcation_id, $detail_pemesanan);

        // dd($data['transaction_hotels']);
        return view('ekstranet.laporan.semua', $data);
    }
}

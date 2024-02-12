<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Helpers\General;
use App\Models\DetailTransaction;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\HostelRoom;
use App\Models\HotelRoom;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardPartnerController extends Controller
{
    public function index(Request $request)
    {
        //        $data['transactions'] = Transaction::with('detailTransaction.product', 'user', 'bookDate')->orderBy('created_at', 'desc')
        //            ->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
        //                $q->where('user_id', $id);
        //            })->orderBy('created_at', 'desc')->take(5)->get();
        //
        //

        //
        // $data['revenueWeek'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
        //     $q->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()]);
        //     $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
        //         $q2->where('user_id', $id);
        //     });
        // })->sum('price');

        //
        //        $data['revenueMonth'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
        //            $q->whereMonth('created_at', '=', date('m'));
        //            $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
        //                $q2->where('user_id', $id);
        //            });
        //        })->sum('price');

        /**
         * VARIABEL ======================================
         */
        $id = auth()->user()->id;
        $dateNow = $request->end_date == null ? Carbon::now()->timezone('Asia/Makassar') : Carbon::parse($request->end_date)->timezone('Asia/Makassar') ;
        
        // Weekly transactions
        $startWeek = $request->has('start_date')
            ? Carbon::parse($request->start_date)->startOfWeek()->format('Y-m-d')
            : $dateNow->copy()->startOfWeek()->format('Y-m-d');
        
        $endWeek = $request->has('end_date')
            ? Carbon::parse($request->end_date)->endOfWeek()->format('Y-m-d')
            : $dateNow->copy()->endOfWeek()->format('Y-m-d');
        
        $transaction_hostel = DB::table('detail_transaction_hostel as dh')
            ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('hostels as h', 'dh.hostel_id', '=', 'h.id')
            ->where('h.user_id', $id)
            ->whereBetween('dh.created_at', [$startWeek, $endWeek])
            ->where('t.status', 'PAID');
        
        $transaction_hotel = DB::table('detail_transaction_hotel as dh')
            ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
            ->join('hotels as h', 'dh.hotel_id', '=', 'h.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->where('h.user_id', $id)
            ->whereBetween('dh.created_at', [$startWeek, $endWeek])
            ->where('t.status', 'PAID');
        
        // Monthly transactions
        $startMonth = Carbon::now()->timezone('Asia/Makassar')->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        
        $trans_hotel_month = DB::table('detail_transaction_hotel as dh')
            ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
            ->join('hotels as h', 'dh.hotel_id', '=', 'h.id')
            ->where('h.user_id', $id)
            ->whereBetween('dh.updated_at', [$startMonth, $dateNow])
            ->where('t.status', 'PAID')
            ->sum('t.total');
        
        $trans_hostel_month = DB::table('detail_transaction_hostel as dh')
            ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
            ->join('hostels as h', 'dh.hostel_id', '=', 'h.id')
            ->where('h.user_id', $id)
            ->whereBetween('dh.updated_at', [$startMonth, $dateNow])
            ->where('t.status', 'PAID')
            ->sum('t.total');
        

    

        $data['revenueWeek'] = $transaction_hotel->sum('t.total') + $transaction_hostel->sum('t.total');

        /**
         * JUMLAH TAMU HOTEL DAN HOSTEL ======================================
         */
        $data['guest'] = $transaction_hotel->sum('guest') + $transaction_hostel->sum('guest');

        // /**
        //  * PENDAPATAN PER BULAN ======================================
        //  */
        // $startMonth = Carbon::now()
        //     ->timezone('Asia/Makassar')
        //     ->subMonth()
        //     ->format('Y-m-d H:i:s');
        // $dateNow = Carbon::now()->timezone('Asia/Makassar');

        // $trans_hotel_month = DB::table('detail_transaction_hotel as dh')
        //     ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
        //     ->join('hotels as h', 'dh.hotel_id', '=', 'h.id')
        //     ->where('h.user_id', $id)
        //     ->whereBetween('dh.updated_at', [$startMonth, $dateNow])
        //     ->where('t.status', '=', 'PAID')
        //     ->sum('t.total');

        // $trans_hostel_month = DB::table('detail_transaction_hostel as dh')
        //     ->join('transactions as t', 'dh.transaction_id', '=', 't.id')
        //     ->join('hostels as h', 'dh.hostel_id', '=', 'h.id')
        //     ->where('h.user_id', $id)
        //     ->whereBetween('dh.updated_at', [$startMonth, $dateNow])
        //     ->where('t.status', '=', 'PAID')
        //     ->sum('t.total');

        //        $trans_hotel_month = DetailTransactionHotel::whereMonth('created_at', '=', date('m'))
        //            ->withWhereHas('transaction', function ($query) use ($id) {
        //                $query->where('user_id', $id);
        //            })->sum('rent_price');
        //
        //        $trans_hostel_month = DetailTransactionHostel::whereMonth('created_at', '=', date('m'))
        //            ->withWhereHas('transaction', function ($query) use ($id) {
        //                $query->where('user_id', $id);
        //            })->sum('rent_price');

        $data['revenueMonth'] = $trans_hotel_month + $trans_hostel_month;

        /**
         * GET HOTEL DAN HOSTEL YANG SUDAH & BELUM TERBOOKING ======================================
         */
        $totalRoomHotel = HotelRoom::with('hostel', function ($q) use ($id) {
            $q->where('user_id', $id);
        })
            ->where('is_active', 1)
            ->sum('totalroom');

        $totalRoomHostel = HostelRoom::with('hostel', function ($q) use ($id) {
            $q->where('user_id', $id);
        })
            ->where('is_active', 1)
            ->sum('totalroom');
        $data['ready'] = $totalRoomHotel + $totalRoomHostel - ($transaction_hotel->sum('room') + $transaction_hostel->sum('room'));

        $data['notready'] = $transaction_hotel->sum('room') + $transaction_hostel->sum('room');

        /**
         * DAFTAR RIWAYAT TERAKHIR
         */
        $data['transaction_hotels'] = $transaction_hotel->get();
        $data['transaction_hostels'] = $transaction_hostel->get();
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        

        /**$data['end_date'] = $startWeek;
         * RETURN VIEW ======================================
         */
        return view('ekstranet.dashboard', $data);
    }
}

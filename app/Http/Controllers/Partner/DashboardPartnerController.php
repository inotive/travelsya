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
use Illuminate\Http\Request;

class DashboardPartnerController extends Controller
{
    public function index()
    {
  
        $id = auth()->user()->id;

        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();
        
        $transaction_hotel = DetailTransactionHotel::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('transaction', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        
        $transaction_hostel = DetailTransactionHostel::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('transaction', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        
        $data['revenueWeek'] = $transaction_hotel->sum('rent_price') + $transaction_hostel->sum('rent_price');
        $data['guest'] = $transaction_hotel->sum('guest') + $transaction_hostel->sum('guest');
        
        $trans_hotel_month = DetailTransactionHotel::whereMonth('created_at', '=', now()->month)
            ->whereHas('transaction', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->sum('rent_price');
        
        $trans_hostel_month = DetailTransactionHostel::whereMonth('created_at', '=', now()->month)
            ->whereHas('transaction', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->sum('rent_price');
        
        $data['revenueMonth'] = $trans_hotel_month + $trans_hostel_month;
        
        $totalRoomHotel = HotelRoom::whereHas('hotel', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('is_active', 1)->sum('totalroom');
        
        $totalRoomHostel = HostelRoom::whereHas('hostel', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('is_active', 1)->sum('totalroom');
        
        $roomCount = $transaction_hotel->sum('room') + $transaction_hostel->sum('room');
        $data['ready'] = ($totalRoomHotel + $totalRoomHostel) - $roomCount;
        $data['notready'] = $roomCount;
        
        $data['transaction_hotels'] = $transaction_hotel->get();
        $data['transaction_hostels'] = $transaction_hostel->get();

     
        return view('ekstranet.dashboard', $data);
    }
}

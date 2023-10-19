<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Helpers\General;
use App\Models\DetailTransaction;
use App\Models\HostelRoom;
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
        //        $transactions = Transaction::with('detailTransaction.product', 'user', 'bookDate')->orderBy('created_at', 'desc')
        //            ->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
        //                $q->where('user_id', $id);
        //            })->orderBy('created_at', 'desc')->take(5)->get();
        //
        //        //card
        //        $card['guest'] = Transaction::withCount('guest')->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
        //            $q->where('user_id', $id);
        //        })->count();
        //
        //        $card['revenueWeek'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
        //            $q->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()]);
        //            $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
        //                $q2->where('user_id', $id);
        //            });
        //        })->sum('price');
        //
        //        $card['revenueMonth'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
        //            $q->whereMonth('created_at', '=', date('m'));
        //            $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
        //                $q2->where('user_id', $id);
        //            });
        //        })->sum('price');
        //
        //        $card['ready'] = HostelRoom::with('hostel', function ($q) use ($id) {
        //            $q->where('user_id', $id);
        //        })->where('is_active', 1)->count();
        //        $card['notready'] = HostelRoom::with('hostel', function ($q) use ($id) {
        //            $q->where('user_id', $id);
        //        })->where('is_active', 0)->count();
        return view('ekstranet.dashboard');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\HostelRoom;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $transactions = Transaction::with('user')->get();
        $countPartner = User::wherein('role', ['1', '2'])->get();
        $countTransactionToday = $transactions->where('created_at', date('y-m-d'))->count();
        $sumTranscationToday = $transactions->where('created_at', date('y-m-d'))->sum('total');
        $sumTranscationMonthly = $transactions->where('month(created_at)', date('m'))->sum('total');
        return view('admin.dashboard', compact('transactions','countPartner','countTransactionToday','sumTranscationToday','sumTranscationToday'));
    }
//    public function index(Request $request)
//    {
//        if (auth()->user()->role == 0) {
//                $transactions = Transaction::with('detailTransaction.hostelRoom.hostel', 'detailTransaction.product', 'services', 'user', 'bookDate')->orderBy('created_at', 'desc')->get();
//                //card
//                $card['partner'] = User::where('role', 1)->count();
//                $card['transactionToday'] = Transaction::where('created_at', date('y-m-d'))->count();
//                $card['sumDayTransaction'] = General::rp(DetailTransaction::withWhereHas('transaction', function ($q) {
//                    $q->where('created_at', date('y-m-d'));
//                })->sum('price'));
//                $card['sumMonthTransaction'] = General::rp(DetailTransaction::withWhereHas('transaction', function ($q) {
//                    $q->whereMonth('created_at', '=', date('m'));
//                })->sum('price'));
//                $services = Service::all();
//                return view('admin.dashboard', compact('transactions', 'services', 'card'));
//            } else {
//                $id = auth()->user()->id;
//                $transactions = Transaction::with('detailTransaction.product', 'user', 'bookDate')->orderBy('created_at', 'desc')
//                    ->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
//                        $q->where('user_id', $id);
//                    })->orderBy('created_at', 'desc')->take(5)->get();
//
//                //card
//                $card['guest'] = Transaction::withCount('guest')->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
//                    $q->where('user_id', $id);
//                })->count();
//
//                $card['revenueWeek'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
//                    $q->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()]);
//                    $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
//                        $q2->where('user_id', $id);
//                    });
//                })->sum('price');
//
//                $card['revenueMonth'] = DetailTransaction::withWhereHas('Transaction', function ($q) use ($id) {
//                    $q->whereMonth('created_at', '=', date('m'));
//                    $q->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q2) use ($id) {
//                        $q2->where('user_id', $id);
//                    });
//                })->sum('price');
//
//                $card['ready'] = HostelRoom::with('hostel', function ($q) use ($id) {
//                    $q->where('user_id', $id);
//                })->where('is_active', 1)->count();
//                $card['notready'] = HostelRoom::with('hostel', function ($q) use ($id) {
//                    $q->where('user_id', $id);
//                })->where('is_active', 0)->count();
//
//            return view('admin.dashboard');
//        }
//    }

}

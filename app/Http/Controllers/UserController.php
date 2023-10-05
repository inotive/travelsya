<?php

namespace App\Http\Controllers;

use App\Models\DetailTransactionPPOB;
use App\Models\Help;
use App\Models\Transaction;
use App\Services\Travelsya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $travelsya;

    public function __construct(Travelsya $travelsya)
    {
        $this->travelsya = $travelsya;
    }

    public function transaction()
    {
        if (!session()->get('user'))
            return redirect()->route('login');

        $transaction = $this->travelsya->listTransaction();
        $transactionData = $transaction['data'];
        if ($transaction['meta']['code'] != 200) {
            $transactionData = 'not found';
        }

        return view('user.transaction', ['transactions' => $transactionData]);
    }
    public function profile()
    {
//        if (empty(Auth::check()))
//            return redirect()->route('login');
//
//        $transaction = $this->travelsya->listTransaction();
//        $transactionData = $transaction['data'];
//        if ($transaction['meta']['code'] != 200) {
//            $transactionData = 'not found';
//        }
        $transactionData = DB::table('transactions')->get();
        return view('user.profile', ['transactions' => $transactionData]);
    }

    public function orderHistory() {
        return view('user.orderhistory');
    }

    public function orderDetailHotel(){
        return view('user.order-detail.hotel');
    }

    public function orderDetailListrikVoucher(){

    $transactionPPOB = DB::table('detail_transaction_ppob')
    ->join('products', 'detail_transaction_ppob.product_id', '=', 'products.id')
    ->join('transactions', 'detail_transaction_ppob.transaction_id', '=', 'transactions.id')
    ->join('users', 'transactions.user_id', '=', 'users.id')
    ->join('history_points', 'detail_transaction_ppob.transaction_id', '=', 'history_points.transaction_id')
    // ->join('history_points', 'detail_transaction_ppob.history_point_id', '=', 'history_points.id')
    ->select(
        'detail_transaction_ppob.*',
        'products.name as product_name',
        'transactions.no_inv as inv_num',
        'transactions.service as service',
        'transactions.created_at as created_transaction',
        'transactions.payment_method as payment_method',
        'transactions.status as status',
        'history_points.point as points',
        'users.name as user_name',

        DB::raw('detail_transaction_ppob.total_tagihan +
        detail_transaction_ppob.fee_travelsya -
        history_points.point
        as total_after_fee
        ')
    )
    ->where('detail_transaction_ppob.id', 2)
    ->first();

    // $transaction = DetailTransactionPPOB::where('id', 2)->first();
        return view('user.order-detail.listrik-voucher', compact('transactionPPOB'));
    }

    public function orderDetailListrik(){

    $transactionPPOB = DB::table('detail_transaction_ppob')
    ->join('products', 'detail_transaction_ppob.product_id', '=', 'products.id')
    ->join('transactions', 'detail_transaction_ppob.transaction_id', '=', 'transactions.id')
    ->join('users', 'transactions.user_id', '=', 'users.id')
    ->join('history_points', 'detail_transaction_ppob.transaction_id', '=', 'history_points.transaction_id')
    // ->join('history_points', 'detail_transaction_ppob.history_point_id', '=', 'history_points.id')
    ->select(
        'detail_transaction_ppob.*',
        'products.name as product_name',
        'transactions.no_inv as inv_num',
        'transactions.service as service',
        'transactions.created_at as created_transaction',
        'transactions.payment_method as payment_method',
        'transactions.status as status',
        'history_points.point as points',
        'users.name as user_name',

        DB::raw('detail_transaction_ppob.total_tagihan +
        detail_transaction_ppob.fee_travelsya -
        history_points.point
        as total_after_fee
        ')
    )
    ->where('detail_transaction_ppob.id', 2)
    ->first();

        return view('user.order-detail.listrik', compact('transactionPPOB'));
    }

    public function help()
    {
        $helps = Help::all();

        return view('user.help', compact('helps'));
    }

    public function detailTransaction($no_inv)
    {
        if (!session()->get('user'))
            return redirect()->route('login.view');

        $detailTransaction = $this->travelsya->detailTransaction($no_inv);
        if ($detailTransaction['meta']['code'] != 200) {
            return redirect()->back();
        }

        return view('user.detailtransaction', ['transaction' => $detailTransaction['data'][0]]);
    }
}

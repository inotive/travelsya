<?php

namespace App\Http\Controllers;

use App\Services\Travelsya;
use Illuminate\Http\Request;

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
            return redirect()->route('login.view');

        $transaction = $this->travelsya->listTransaction();
        $transactionData = $transaction['data'];
        if ($transaction['meta']['code'] != 200) {
            $transactionData = 'not found';
        }

        return view('user.transaction', ['transactions' => $transactionData]);
    }
    public function profile()
    {
        if (!session()->get('user'))
            return redirect()->route('login.view');

        $transaction = $this->travelsya->listTransaction();
        $transactionData = $transaction['data'];
        if ($transaction['meta']['code'] != 200) {
            $transactionData = 'not found';
        }
        return view('user.profile', ['transactions' => $transactionData]);
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

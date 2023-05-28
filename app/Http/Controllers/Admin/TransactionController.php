<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role == 0) {
            $tr = Transaction::with('user', 'detailTransaction');
        } else {
            $id = auth()->user()->id;
            $tr = Transaction::with('user', 'detailTransaction')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
                $q->where('user_id', $id);
            })->where('service', 'hostel');
        }

        if ($request->service != null)
            $tr = $tr->where('service', 'like', '%' . $request->service . '%');

        if ($request->start != null) {
            $tr = $tr->whereDate('created_at', '>=', $request->start)->whereDate('created_at', '<=', $request->end);
        }

        $transactions = $tr->paginate(10);

        return view('admin.transaction', compact('transactions'));
    }

    public function detail($id)
    {
        if (auth()->user()->role == 0) {
            $transaction = Transaction::with('detailTransaction.product', 'detailTransaction.hostelRoom.hostel', 'guest', 'bookDate')->findOrFail($id);
        } else {
            $idUser = auth()->user()->id;
            $transaction = Transaction::with('detailTransaction.product', 'detailTransaction.hostelRoom.hostel', 'guest', 'bookDate')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($idUser) {
                $q->where('user_id', $idUser);
            })->findOrFail($id);
        }

        return view('admin.transaction-detail', compact('transaction'));
    }

    public function detailUpdate(Request $request)
    {
        $detail = DetailTransaction::find($request->id);
        $detail->update(['status' => $request->status]);
        // ifservicepulsa ifsuccess direct transaction to mymili
        toast('Status has been updated', 'info');
        return redirect()->route('admin.transaction.detail', $request->idtr);
    }
}

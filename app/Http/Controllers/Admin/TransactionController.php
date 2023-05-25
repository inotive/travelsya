<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $tr = Transaction::with('user');

        if ($request->service != null)
            $tr = $tr->where('service', $request->service);

        if ($request->start != null) {
            $tr = $tr->whereDate('created_at', '>=', $request->start)->whereDate('created_at', '<=', $request->end);
        }

        $transactions = $tr->paginate(10);

        return view('admin.transaction', compact('transactions'));
    }
}

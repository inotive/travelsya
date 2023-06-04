<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with('detailTransaction.hostelRoom.hostel', 'detailTransaction.product', 'service')->orderBy('created_at', 'desc')->get();
        $categories = Service::all();
        return view('admin.dashboard', compact('transactions', 'categories'));
    }
}

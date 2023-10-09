<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 2)
            ->with('transaction')
            ->paginate(10);

        
        return view('admin.management-customer.index', compact('customers'));
    }

    // public function show($id)
    // {
    //     $customers = User::where('id', $id)
    //     ->
    //     ->get();
    // }
}

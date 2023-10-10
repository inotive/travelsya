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

    public function showDetailtransaction(Request $request)
    {
        $customerId = $request->input('customerId');

        // Ambil data detail transaksi berdasarkan $customerId
        $detailTransactions = DB::table('transactions')
            ->leftJoin('detail_transactions', function ($join) {
                $join->on('transactions.id', '=', 'detail_transactions.transaction_id');
            })
            ->leftJoin('detail_transaction_hotel', function ($join) {
                $join->on('transactions.id', '=', 'detail_transaction_hotel.transaction_id');
            })
            ->leftJoin('detail_transaction_hostel', function ($join) {
                $join->on('transactions.id', '=', 'detail_transaction_hostel.transaction_id');
            })
            ->leftJoin('hotels', 'detail_transaction_hotel.hotel_id', '=', 'hotels.id')
            ->leftJoin('hotel_rooms', 'detail_transaction_hotel.hotel_room_id', '=', 'hotel_rooms.id')
            ->leftJoin('hostels', 'detail_transaction_hostel.hostel_id', '=', 'hostels.id')
            ->leftJoin('hostel_rooms', 'detail_transaction_hostel.hostel_room_id', '=', 'hostel_rooms.id')
            ->leftJoin('services', 'transactions.service_id', '=', 'services.id')
            ->leftJoin('points', 'transactions.service_id', '=', 'points.service_id')
            ->leftJoin('products', 'detail_transactions.product_id', '=', 'products.id')
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id') // Join dengan tabel products
            ->selectRaw('transactions.id, transactions.user_id, users.name as user, detail_transactions.price as transaction_price, 
                        detail_transaction_hotel.rent_price as hotel_rent_price,
                        hotels.name as hotel_name, hotel_rooms.name as hotel_room,
                        hostels.name as hostel_name, hostel_rooms.name as hostel_room,
                        services.name as service_name,
                        points.value as points_value,
                        products.name as product_name, products.description as product_desc,
                        transactions.no_inv, transactions.service, transactions.payment_method,
                        transactions.created_at,
                        detail_transaction_hostel.rent_price as hostel_rent_price')
            ->where('transactions.user_id', $customerId)
            ->where(function ($query) {
                $query->where('detail_transactions.status', 'SUCCESS')
                    ->orWhereNull('detail_transactions.id'); // Handle jika detail_transactions.id adalah NULL
            })
            ->get();

        $detailTransactions = $detailTransactions->groupBy('id')->map(function ($item) {
            return [
                'id' => $item[0]->id,
                'user_id' => $item[0]->user_id,
                'user' => $item[0]->user,
                'transaction_price' => $item[0]->transaction_price ?? $item[0]->hotel_rent_price ?? $item[0]->hostel_rent_price,
            
                'transaction_name' => $item[0]->hotel_name ?? $item[0]->hostel_name ?? $item[0]->product_name,
                'transaction_desc' => $item[0]->hotel_room ?? $item[0]->hostel_room ?? $item[0]->product_desc,
            
                'service_name' => $item[0]->service_name,
                'point' => $item[0]->points_value,
                'no_inv' => $item[0]->no_inv,
                
                'payment_method' => $item[0]->payment_method,
                'created_at' => $item[0]->created_at,
                
            ];
        })->values()->all();

        // dd($detailTransactions);
        // return view('admin.management-customer.detail_transactions', compact('detailTransactions'));
        return response()->json($detailTransactions);
    }
}

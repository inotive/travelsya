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
            ->leftJoin('detail_transaction_top_up', function ($join) {
                $join->on('transactions.id', '=', 'detail_transaction_top_up.transaction_id');
            })
            ->leftJoin('detail_transaction_ppob', function ($join) {
                $join->on('transactions.id', '=', 'detail_transaction_ppob.transaction_id');
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
            ->leftJoin('history_points as debit_points', 'transactions.id', '=', 'debit_points.transaction_id')
            ->leftJoin('history_points as credit_points', 'transactions.id', '=', 'credit_points.transaction_id')
            ->leftJoin('products', 'detail_transaction_top_up.product_id', '=', 'products.id')
            ->leftJoin('products as ppob_products', 'detail_transaction_ppob.product_id', '=', 'ppob_products.id') // Tambah leftJoin ke tabel products (sebagai ppob_products)
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id') // Join dengan tabel products
            ->selectRaw('transactions.id, transactions.user_id, users.name as user,
                detail_transaction_ppob.total_tagihan as ppob_price,
                hotels.name as hotel_name, hotel_rooms.name as hotel_room,
                hostels.name as hostel_name, hostel_rooms.name as hostel_room,
                services.name as service_name,
                transactions.service as services_nama,
                transactions.total as transaction_price,
                products.name as product_name, products.description as product_desc,
                ppob_products.name as ppob_product_name, ppob_products.description as ppob_product_desc,
                transactions.no_inv, transactions.service, transactions.payment_method,
                debit_points.point as debit_point, credit_points.point as credit_point,
                COALESCE(SUM(COALESCE(detail_transaction_top_up.fee_travelsya, 0) + COALESCE(detail_transaction_top_up.fee_mili, 0) + COALESCE(detail_transaction_top_up.kode_unik, 0)), 0) as fee_admin_top,
                COALESCE(SUM(COALESCE(detail_transaction_ppob.fee_travelsya, 0) + COALESCE(detail_transaction_ppob.fee_mili, 0) + COALESCE(detail_transaction_ppob.kode_unik, 0)), 0) as fee_admin_ppob,
                COALESCE(SUM(COALESCE(detail_transaction_hotel.fee_admin, 0) + COALESCE(detail_transaction_hotel.kode_unik, 0)), 0) as fee_admin_hotel,
                COALESCE(SUM(COALESCE(detail_transaction_hostel.fee_admin, 0) + COALESCE(detail_transaction_hostel.kode_unik, 0)), 0) as fee_admin_hostel,
                transactions.created_at')
            ->where('transactions.user_id', $customerId)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('detail_transaction_top_up.status', 'SUCCESS')
                          ->orWhereNull('detail_transaction_top_up.id');
                })
                ->where(function ($query) {
                    $query->where('detail_transaction_ppob.status', 'SUCCESS')
                          ->orWhereNull('detail_transaction_ppob.id');
                });
            })
            ->where(function ($query) {
                $query->where('debit_points.flow', 'debit')
                      ->orWhereNull('debit_points.flow');
            })->where(function ($query) {
                $query->where('credit_points.flow', 'credit')
                      ->orWhereNull('credit_points.flow');
            })
            ->groupBy('transactions.id', 'transactions.user_id', 'users.name', 'detail_transaction_ppob.total_tagihan', 'hotels.name', 'hotel_rooms.name', 'hostels.name', 'hostel_rooms.name', 'services.name', 'transactions.service', 'transactions.total', 'products.name', 'products.description', 'ppob_products.name', 'ppob_products.description', 'transactions.no_inv', 'transactions.service', 'transactions.payment_method', 'debit_points.point', 'credit_points.point', 'transactions.created_at')
            ->get();

        $detailTransactions = $detailTransactions->groupBy('id')->map(function ($item) {
            $feeAdmin = 0;
            if ($item[0]->fee_admin_top !== "0") {
                $feeAdmin = $item[0]->fee_admin_top;
            } elseif ($item[0]->fee_admin_ppob !== "0") {
                $feeAdmin = $item[0]->fee_admin_ppob;
            } elseif ($item[0]->fee_admin_hotel !== "0") {
                $feeAdmin = $item[0]->fee_admin_hotel;
            } elseif ($item[0]->fee_admin_hostel !== "0") {
                $feeAdmin = $item[0]->fee_admin_hostel;
            } else {
                $feeAdmin = 0;
            }
            return [
                'id' => $item[0]->id,
                'user_id' => $item[0]->user_id,
                'user' => $item[0]->user,
                'transaction_price' => $item[0]->transaction_price,
                'transaction_name' => $item[0]->hotel_name ?? $item[0]->hostel_name ?? $item[0]->product_name ?? $item[0]->ppob_product_name,
                'transaction_desc' => $item[0]->hotel_room ?? $item[0]->hostel_room ?? $item[0]->product_desc ?? $item[0]->ppob_product_desc,
                'fee_admin' => (int)$feeAdmin ,
                'service_name' => $item[0]->service_name,
                'debit_point' => $item[0]->debit_point ?? 0,
                'credit_point' => $item[0]->credit_point ?? 0,
                'no_inv' => $item[0]->no_inv,
                'payment_method' => $item[0]->payment_method,
                'created_at' => $item[0]->created_at,
            ];
        })->values()->all();

        //dd($detailTransactions);

        return response()->json($detailTransactions);
    }

    // public function showDetailtransaction(Request $request)
    // {
    //     $customerId = $request->input('customerId');

    //     // Ambil data detail transaksi berdasarkan $customerId
    //     $detailTransactions = DB::table('transactions')
    //         ->leftJoin('detail_transactions', function ($join) {
    //             $join->on('transactions.id', '=', 'detail_transactions.transaction_id');
    //         })
    //         ->leftJoin('detail_transaction_hotel', function ($join) {
    //             $join->on('transactions.id', '=', 'detail_transaction_hotel.transaction_id');
    //         })
    //         ->leftJoin('detail_transaction_hostel', function ($join) {
    //             $join->on('transactions.id', '=', 'detail_transaction_hostel.transaction_id');
    //         })
    //         ->leftJoin('hotels', 'detail_transaction_hotel.hotel_id', '=', 'hotels.id')
    //         ->leftJoin('hotel_rooms', 'detail_transaction_hotel.hotel_room_id', '=', 'hotel_rooms.id')
    //         ->leftJoin('hostels', 'detail_transaction_hostel.hostel_id', '=', 'hostels.id')
    //         ->leftJoin('hostel_rooms', 'detail_transaction_hostel.hostel_room_id', '=', 'hostel_rooms.id')
    //         ->leftJoin('services', 'transactions.service_id', '=', 'services.id')
    //         ->leftJoin('points', 'transactions.service_id', '=', 'points.service_id')
    //         ->leftJoin('products', 'detail_transactions.product_id', '=', 'products.id')
    //         ->leftJoin('users', 'transactions.user_id', '=', 'users.id') // Join dengan tabel products
    //         ->selectRaw('transactions.id, transactions.user_id, users.name as user, detail_transactions.price as transaction_price,
    //                     detail_transaction_hotel.rent_price as hotel_rent_price,
    //                     hotels.name as hotel_name, hotel_rooms.name as hotel_room,
    //                     hostels.name as hostel_name, hostel_rooms.name as hostel_room,
    //                     services.name as service_name,
    //                     points.value as points_value,
    //                     products.name as product_name, products.description as product_desc,
    //                     transactions.no_inv, transactions.service, transactions.payment_method,
    //                     transactions.created_at,
    //                     detail_transaction_hostel.rent_price as hostel_rent_price')
    //         ->where('transactions.user_id', $customerId)
    //         ->where(function ($query) {
    //             $query->where('detail_transactions.status', 'SUCCESS')
    //                 ->orWhereNull('detail_transactions.id'); // Handle jika detail_transactions.id adalah NULL
    //         })
    //         ->get();

    //     $detailTransactions = $detailTransactions->groupBy('id')->map(function ($item) {
    //         return [
    //             'id' => $item[0]->id,
    //             'user_id' => $item[0]->user_id,
    //             'user' => $item[0]->user,
    //             'transaction_price' => $item[0]->transaction_price ?? $item[0]->hotel_rent_price ?? $item[0]->hostel_rent_price,
    //             'transaction_name' => $item[0]->hotel_name ?? $item[0]->hostel_name ?? $item[0]->product_name,
    //             'transaction_desc' => $item[0]->hotel_room ?? $item[0]->hostel_room ?? $item[0]->product_desc,
    //             'service_name' => $item[0]->service_name,
    //             'point' => $item[0]->points_value,
    //             'no_inv' => $item[0]->no_inv,
    //             'payment_method' => $item[0]->payment_method,
    //             'created_at' => $item[0]->created_at,

    //         ];
    //     })->values()->all();

    //     // dd($detailTransactions);
    //     // return view('admin.management-customer.detail_transactions', compact('detailTransactions'));
    //     return response()->json($detailTransactions);
    // }
}

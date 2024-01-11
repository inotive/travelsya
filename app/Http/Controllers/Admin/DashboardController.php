<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\HostelRoom;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $card['partner'] = User::where('role', 1)->count();
        $card['transactionToday'] = Transaction::whereDate('created_at', today())->count();

        $sumDayTransaction = Transaction::whereDate('created_at', date('y-m-d'))->sum('total');
        $sumMonthTransaction = Transaction::whereMonth('created_at', date('m'))->sum('total');

        $card['sumDayTransaction'] = General::rp($sumDayTransaction);


        $firstDayOfMonth = now()->startOfMonth();
        $lastDayOfMonth = now()->endOfMonth();

        $card['sumMonthTransaction'] = General::rp($sumMonthTransaction);

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
            ->leftJoin('points', 'transactions.service_id', '=', 'points.service_id')
            ->leftJoin('products', 'detail_transaction_top_up.product_id', '=', 'products.id')
            ->leftJoin('products as ppob_products', 'detail_transaction_ppob.product_id', '=', 'ppob_products.id') // Tambah leftJoin ke tabel products (sebagai ppob_products)
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id') // Join dengan tabel products
            ->selectRaw('transactions.id, transactions.user_id, users.name as user,
                    transactions.total as transaction_price,
                    hotels.name as hotel_name, hotel_rooms.name as hotel_room,
                    hostels.name as hostel_name, hostel_rooms.name as hostel_room,
                    services.name as service_name,
                    detail_transaction_hotel.fee_admin as hotel_fee,
                    detail_transaction_hostel.fee_admin as hostel_fee,
                    detail_transaction_ppob.fee_travelsya as ppob_fee,
                    detail_transaction_top_up.fee_travelsya as topup_fee,
                    transactions.service as service_nama,
                    points.value as points_value,
                    products.name as product_name, products.description as product_desc,
                    ppob_products.name as ppob_product_name, ppob_products.description as ppob_product_desc,
                    transactions.no_inv, transactions.service, transactions.payment_method,
                    transactions.created_at,
                    COALESCE(SUM(COALESCE(detail_transaction_top_up.fee_travelsya, 0) + COALESCE(detail_transaction_top_up.fee_mili, 0) + COALESCE(detail_transaction_top_up.kode_unik, 0)), 0) as fee_admin_top,
                    COALESCE(SUM(COALESCE(detail_transaction_ppob.fee_travelsya, 0) + COALESCE(detail_transaction_ppob.fee_mili, 0) + COALESCE(detail_transaction_ppob.kode_unik, 0)), 0) as fee_admin_ppob,
                    COALESCE(SUM(COALESCE(detail_transaction_hotel.fee_admin, 0) + COALESCE(detail_transaction_hotel.kode_unik, 0)), 0) as fee_admin_hotel,
                    COALESCE(SUM(COALESCE(detail_transaction_hostel.fee_admin, 0) + COALESCE(detail_transaction_hostel.kode_unik, 0)), 0) as fee_admin_hostel,
                    detail_transaction_hostel.rent_price as hostel_rent_price')
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
            ->groupBy('transactions.id', 'transactions.user_id', 'users.name', 'detail_transaction_ppob.total_tagihan', 'hotels.name', 'hotel_rooms.name', 'hostels.name', 'hostel_rooms.name', 'services.name', 'transactions.service', 'transactions.total', 'products.name', 'products.description', 'ppob_products.name', 'ppob_products.description', 'transactions.no_inv', 'transactions.service', 'transactions.payment_method', 'transactions.created_at', 'detail_transaction_hotel.fee_admin', 'travelsya.detail_transaction_hostel.fee_admin', 'travelsya.detail_transaction_ppob.fee_travelsya', 'travelsya.detail_transaction_top_up.fee_travelsya', 'travelsya.points.value', 'travelsya.detail_transaction_hostel.rent_price')
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
                'transaction_price' => $item[0]->transaction_price ?? $item[0]->hotel_rent_price ?? $item[0]->hostel_rent_price ?? $item[0]->ppob_price,
                'transaction_name' => $item[0]->hotel_name ?? $item[0]->hostel_name ?? $item[0]->product_name ?? $item[0]->ppob_product_name,
                'transaction_desc' => $item[0]->hotel_room ?? $item[0]->hostel_room ?? $item[0]->product_desc ?? $item[0]->ppob_product_desc,
                'service_name' => $item[0]->service_nama,
                'point' => $item[0]->points_value,
                'fee' => (int)$feeAdmin,
                'no_inv' => $item[0]->no_inv,
                'payment_method' => $item[0]->payment_method,
                'created_at' => Carbon::parse($item[0]->created_at)->format('d M Y'), // Memformat tanggal

            ];
        })->values()->all();


        $detailTransactionHotel = collect($detailTransactions)->filter(function ($item) {
            return $item['service_name'] === 'hotel';
        });

        $detailTransactionHostel = collect($detailTransactions)->filter(function ($item) {
            return $item['service_name'] === 'hostel';
        });
        $transaksiPPOB = Transaction::with('detailTransactionPPOB','user','services')
            ->whereIn('service_id', [3,4,5,6,9,10])
            ->where('status', 'PAID')
            ->orderByDesc('created_at')
            ->get();

        $transaksiTopUp = Transaction::with('detailTransactionTopUp','user','services')
            ->whereIn('service_id', [1,2,11,12])
            ->where('status', 'PAID')
            ->orderByDesc('created_at')
            ->get();


//            DB::table('transactions as t')
//            ->join('services as s', 't.service_id', '=', 's.id')
//            ->join('users as u', 't.user_id', '=', 'u.id')
//            ->rightJoin('detail_transaction_ppob as dp', 'dp.transaction_id', '=', 't.id')
//            ->whereIn('service_id', [1,2,3,4,5,6,9,10])
//            ->select('t.*', 'u.name as pelanggan', 's.name as service_name','dp.nomor_pelanggan')
//            ->get();
        $detailTransactionPPOB =
            collect($detailTransactions)->filter(function ($item) {
            return strpos($item['no_inv'], 'PPOB') !== false || strpos($item['no_inv'], '%PPOB%') !== false;
        });

        $detailTransactionPulsa = collect($detailTransactions)->filter(function ($item) {
            return (strpos(strtolower($item['service_name']), 'pulsa') !== false || strpos(strtolower($item['service_name']), 'data') !== false)
                && strpos(strtolower($item['service_name']), 'ppob-pulsa') === false;
        });
        return view('admin.dashboard', compact('card','transaksiTopUp', 'transaksiPPOB','detailTransactions', 'detailTransactionHotel', 'detailTransactionHostel', 'detailTransactionPPOB', 'detailTransactionPulsa'));
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

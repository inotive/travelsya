<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\BookDate;
use App\Models\DetailTransaction;
use App\Models\Guest;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role == 0) {
            $tr = Transaction::with('user')
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
            ->where('transactions.deleted_at', null)
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'desc')
            ->selectRaw('
                transactions.id,
                transactions.no_inv,
                transactions.payment_method,
                transactions.payment_channel,
                transactions.status,
                transactions.total,
                transactions.service as service,
                transactions.created_at,
                transactions.service_id,
                MAX(detail_transaction_hotel.fee_admin) + MAX(detail_transaction_hotel.kode_unik) as hotel_fee,
                MAX(detail_transaction_hostel.fee_admin) + MAX(detail_transaction_hostel.kode_unik) as hostel_fee,
                MAX(detail_transaction_ppob.fee_travelsya) + MAX(detail_transaction_ppob.kode_unik) as ppob_fee,
                MAX(detail_transaction_top_up.fee_travelsya) + MAX(detail_transaction_top_up.kode_unik) as topup_fee')
            ->get();
        } else {
            $id = auth()->user()->id;
            $tr = Transaction::with('user')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
                $q->where('user_id', $id);
            })->where('service', 'hostel');
        }

        if ($request->service != null)
            $tr = $tr->where('service_id', $request->service);

            if ($request->filled('start') && $request->filled('end')) {
                $start = date('Y-m-d', strtotime($request->start));
                $end = date('Y-m-d', strtotime($request->end));
            
                $tr = $tr->whereBetween('created_at', [$start, $end]);
            }

        $transactions = $tr;

        $services = Service::all();
        return view('admin.transaction', compact('transactions', 'services'));
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

    // public function store(TransactionRequest $request)
    // {

    //     $request['service'] = 'hostel';
    //     $request['inv'] = "INV-" . date('Ymd') . "-" . strtoupper($request['service']) . "-" . time();
    //     $request['payment'] = 'onthespot';
    //     $request['status'] = 'PAID';
    //     $date = explode(" - ", $request->date);
    //     $request['start'] = date('Y/m/d', strtotime($date[0]));
    //     $request['end'] = date('Y/m/d', strtotime($date[1]));
    //     // cek book date
    //     $checkBook = BookDate::where("hostel_room_id", $request['hostel_room_id'])->where('start', '>=', $request['start'])->where('end', "<=", $request['end'])->first();
    //     if ($checkBook) {
    //         toast('Date has been booked', 'error');
    //         return redirect()->back();
    //     }

    //     DB::transaction(function () use ($request) {
    //         // dd($request->all());
    //         $transaction = Transaction::create([
    //             'no_inv' => $request['inv'],
    //             'service' => $request['service'],
    //             'payment' => $request['payment'],
    //             'payment_method' => $request['payment_method'],
    //             'payment_channel' => $request['payment_channel'],
    //             'user_id' => auth()->user()->id,
    //             'status' => $request['status']
    //         ]);

    //         // detail
    //         $hostelRoom = HostelRoom::find($request['hostel_room_id']);
    //         DetailTransaction::create([
    //             'transaction_id' => $transaction->id,
    //             'hostel_room_id' => $request['hostel_room_id'],
    //             'qty' => 1,
    //             'price' => $hostelRoom->price,
    //             'status' => 'SUCCESS'
    //         ]);

    //         // bookdate
    //         BookDate::create([
    //             'transaction_id' => $transaction->id,
    //             'hostel_room_id' => $request['hostel_room_id'],
    //             'start' => $request['start'],
    //             'end' => $request['end'],
    //         ]);


    //         // guest
    //         Guest::create([
    //             'transaction_id' => $transaction->id,
    //             'name' => $request['name'],
    //             'identity' => $request['identity'],
    //             'type_id' => $request['type_id'],
    //         ]);
    //     });
    //     toast('Transaction has been created', 'success');
    //     return redirect()->back();
    // }
}

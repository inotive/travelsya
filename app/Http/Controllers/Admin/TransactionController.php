<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\BookDate;
use App\Models\DetailTransaction;
use App\Models\Guest;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role == 0) {
            $tr = Transaction::with('user', 'detailTransaction');
            $hostels = Hostel::with('hostelRoom')->get();
        } else {
            $id = auth()->user()->id;
            $tr = Transaction::with('user', 'detailTransaction')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
                $q->where('user_id', $id);
            })->where('service', 'hostel');
            $hostels = Hostel::with('hostelRoom')->where('user_id', $id)->get();
        }

        if ($request->service != null)
            $tr = $tr->where('service', 'like', '%' . $request->service . '%');

        if ($request->start != null) {
            $tr = $tr->whereDate('created_at', '>=', $request->start)->whereDate('created_at', '<=', $request->end);
        }

        $transactions = $tr->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.transaction', compact('transactions', 'hostels'));
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

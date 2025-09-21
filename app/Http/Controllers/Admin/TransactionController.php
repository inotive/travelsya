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
use Mpdf\Mpdf;

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
                ->groupBy(
                    'transactions.id',
                    'transactions.no_inv',
                    'transactions.payment_method',
                    'transactions.payment_channel',
                    'transactions.status',
                    'transactions.total',
                    'transactions.service',
                    'transactions.created_at',
                    'transactions.service_id'
                )
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
                MAX(detail_transaction_top_up.fee_travelsya) + MAX(detail_transaction_top_up.kode_unik) as topup_fee');
            // ->get();
        } else {
            $id = auth()->user()->id;
            $tr = Transaction::with('user')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($id) {
                $q->where('user_id', $id);
            });
        }

        if ($request->service != null)
            $tr = $tr->where('service_id', $request->service);

        // if ($request->start != null) {
        //     $tr = $tr->whereDate('transactions.created_at', '>=', $request->start );
        // }
        // if ($request->end != null) {
        //     $tr = $tr->whereDate('transactions.created_at', '>=', $request->end );
        // }

        if ($request->start != null && $request->end != null) {
            $tr = $tr->whereDate('transactions.created_at', '>= ', $request->start)
                ->whereDate('transactions.created_at', '<=', $request->end);
        } elseif ($request->start != null) {
            $tr = $tr->whereDate('transactions.created_at', '>=', $request->start);
        } elseif ($request->end != null) {
            $tr = $tr->whereDate('transactions.created_at', '<=', $request->end);
        }

        $transactions = $tr->orderBy('no_inv', 'desc')->get();

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

    public function getDetail($id)
    {
        if (auth()->user()->role == 0) {
            $transaction = Transaction::with('user', 'detailTransactionPPOB', 'detailTransactionTopUp', 'detailTransactionHotel', 'detailTransactionHostel', 'historyPoint')->findOrFail($id);
        } else {
            $idUser = auth()->user()->id;
            $transaction = Transaction::with('user', 'detailTransactionPPOB', 'detailTransactionTopUp', 'detailTransactionHotel', 'detailTransactionHostel', 'historyPoint')->withWhereHas('detailTransaction.hostelRoom.hostel', function ($q) use ($idUser) {
                $q->where('user_id', $idUser);
            })->findOrFail($id);
        }

        // Calculate financial details
        $harga = 0;
        $biayaLayanan = 0;
        $potonganPoint = $transaction->historyPoint->first()->point ?? 0;
        $grandTotal = $transaction->total;

        if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10])) {
            $harga = $transaction->total - ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
            $biayaLayanan = ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
        } elseif (in_array($transaction->service_id, [1, 2, 11, 12])) {
            $harga = $transaction->total - ($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0);
            $biayaLayanan = ($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0);
        } elseif ($transaction->service_id == 8) {
            $harga = $transaction->total - ($transaction->detailTransactionHotel->first()->fee_admin ?? 0) - ($transaction->detailTransactionHotel->first()->kode_unik ?? 0);
            $biayaLayanan = ($transaction->detailTransactionHotel->first()->fee_admin ?? 0) + ($transaction->detailTransactionHotel->first()->kode_unik ?? 0);
        } elseif ($transaction->service_id == 7) {
            $harga = $transaction->total - ($transaction->detailTransactionHostel->first()->fee_admin ?? 0) - ($transaction->detailTransactionHostel->first()->kode_unik ?? 0);
            $biayaLayanan = ($transaction->detailTransactionHostel->first()->fee_admin ?? 0) + ($transaction->detailTransactionHostel->first()->kode_unik ?? 0);
        }

        // Format status
        $statusHtml = '';
        if ($transaction->status == 'PAID') {
            $statusHtml = '<span class="badge badge-rounded badge-success">Sukses</span>';
        } elseif ($transaction->status == 'PENDING') {
            $statusHtml = '<span class="badge badge-rounded badge-warning">Pending</span>';
        } else {
            $statusHtml = '<span class="badge badge-rounded badge-danger">Gagal</span>';
        }

        return response()->json([
            'waktu' => \Carbon\Carbon::parse($transaction->created_at)->format('d M y H:i'),
            'invoice' => $transaction->no_inv,
            'service' => strtoupper($transaction->service ?? '-'),
            'payment' => $transaction->payment_method . " - " . $transaction->payment_channel,
            'status' => $statusHtml,
            'user_name' => $transaction->user->name ?? '-',
            'user_email' => $transaction->user->email ?? '-',
            'user_phone' => $transaction->user->phone ?? '-',
            'harga' => 'Rp. ' . number_format($harga, 0, ',', '.'),
            'biaya_layanan' => 'Rp. ' . number_format($biayaLayanan, 0, ',', '.'),
            'potongan_point' => 'Rp. ' . number_format($potonganPoint, 0, ',', '.'),
            'grand_total' => 'Rp. ' . number_format($grandTotal, 0, ',', '.')
        ]);
    }

    public function generatePdf($id, Request $request)
    {
        // Ambil transaksi
        $transaction = Transaction::findOrFail($id);

        // Tentukan jenis detail berdasarkan service_id
        // 1: TopUp, 2: TopUp, 3-6,9,10: PPOB, 7: Hostel, 8: Hotel, 11: CarRental, 12: Recreation, 13: HealthBeauty, 14: Bus
        $service = $transaction->service;

        // Default
        $data = [];
        $view = '';
        try {
            if ($service == 'health-beauty') { // HealthBeauty
                $detail = \App\Models\DetailTransactionHealthBeauty::with('transaction', 'package', 'clinic')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-health-beauty-pdf', $data);
            } elseif ($service == 'hotel') { // Hotel
                $detail = \App\Models\DetailTransactionHotel::with('hotel.hotelroomFacility.facility', 'hotelRoom.hotelRoomFacility.facility', 'transaction.user')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-hotel-pdf', $data);
            } elseif ($service == 'hostel') { // Hostel
                $detail = \App\Models\DetailTransactionHostel::with('hostel.hostelFacilities.facility', 'hostelRoom.hostelFacilities.facility', 'transaction.user')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-hostel-pdf', $data);
            } elseif ($service == 'car-rent') { // CarRental
                $detail = \App\Models\DetailTransactionCarRental::with('carRental', 'car.brand', 'car.carModel', 'transaction.user')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-car-rental-pdf', $data);
            } elseif ($service == 'Recreation') { // Recreation
                $detail = \App\Models\DetailTransactionRecreation::with('recreation', 'package', 'transaction.user')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-recreation-pdf', $data);
            } elseif ($service == 'bus-travel') { // Bus
                $detail = \App\Models\DetailTransactionBus::with('busTravel', 'busTravelHasBus', 'departure', 'transaction.user')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                // Untuk modal atau tidak
                return view('admin.pdf.e-tiket-bus-pdf', $data);
            } elseif ($service == 'ppob') {
                $detail = \App\Models\DetailTransactionHealthBeauty::with('transaction', 'package', 'clinic')
                    ->where('transaction_id', $transaction->id)->firstOrFail();
                $data = ['data' => $detail];
                return view('admin.pdf.e-tiket-ppob-pdf', $data);
            } else {
                // Default fallback jika service tidak dikenali
                $harga = $transaction->total - ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
                $biayaLayanan = ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
                $potonganPoint = $transaction->historyPoint->first()->point ?? 0;
                $grandTotal = $transaction->total;
                return view('admin.pdf.transaction-pdf', [
                    'transaction' => $transaction,
                    'harga' => $harga,
                    'biayaLayanan' => $biayaLayanan,
                    'potonganPoint' => $potonganPoint,
                    'grandTotal' => $grandTotal,
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

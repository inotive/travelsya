<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\DetailTransactionPPOB;
use App\Models\DetailTransactionTopUp;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Product;
use App\Models\Transaction;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Xendit\Xendit;
use Carbon\Carbon;

class TransactionController extends Controller
{
    protected $detailTransaction;

    public function getTransactionUser(Request $request)
    {
        try {
            // $user_id = $request->user()->id;
            $user_id = 5;

            // $transaction = Transaction::with('detailTransaction.hostelRoom', 'detailTransaction.product')
            //     ->where('user_id', $user_id)
            //     ->orderBy('id', 'desc')
            //     ->get();
            $transaction = Transaction::where('user_id', $user_id)
                ->latest()
                ->get();

            $responsTransaction = $transaction->map(function ($transaction) {
                $detailTransaction = $this->getDetailTransaction($transaction->id,$transaction->service_id);
                return [
                    'id' => $transaction->id,
                    'no_inv' => $transaction->no_inv,
                    'req_id' => $transaction->req_id,
                    'link' => $transaction->link,
                    'service' => $transaction->service,
                    'payment' => $transaction->payment,
                    'payment_method' => $transaction->payment_method,
                    'payment_channel' => $transaction->payment_channel,
                    'status' => $transaction->status,
                    'total' => $transaction->total,
                    'created_at' => $transaction->created_at,
                    'detail_transactions' => $detailTransaction,
                ];
            });
            
            if (count($transaction)) {
                return ResponseFormatter::success($responsTransaction, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Fetch data failed', 500);
        }
    }

    protected function getDetailTransaction($transaction_id,$service_id){
        if($service_id == 7){
            $data = DetailTransactionHostel::where('transaction_id',$transaction_id)->first();
            $hostelName = Hostel::where('id',$data->id)->first()->name;
            $hostelRoom = HostelRoom::where('hostel_id',$data->id)->where('id',$data->room)->first()->name;
            $reservationEnd = Carbon::parse($data->reservation_end);
            $reservationStart = Carbon::parse($data->reservation_start);
            $daysDiff = $reservationEnd->diffInDays($reservationStart);
            return  [
                'hostel_name' => $hostelName,
                'room_type' => $hostelRoom,
                'reservation_duration' => $daysDiff
            ];
        }else if($service_id == 8){
            $data = DetailTransactionHotel::where('transaction_id',$transaction_id)->first();
            $hotelName = Hotel::where('id',$data->id)->first()->name;
            $hotelRoom = HotelRoom::where('hotel_id',$data->id)->where('id',$data->room)->first()->name;
            $reservationEnd = Carbon::parse($data->reservation_end);
            $reservationStart = Carbon::parse($data->reservation_start);
            $daysDiff = $reservationEnd->diffInDays($reservationStart);
            return  [
                'hotel_name' => $hotelName,
                'room_type' => $hotelRoom,
                'reservation_duration' => $daysDiff
            ];
        }else{
            if($service_id == 1){
                $dataPulsa = DetailTransactionTopUp::where('transaction_id',$transaction_id)->first();
                $nomorTelfon = $dataPulsa->nomor_telfon;
                $productName = Product::where('id',$dataPulsa->product_id)->first()->name;
                return  [
                    'product_name' => $productName,
                    'phone_number' => $nomorTelfon,
                ];
            }else{
                $dataPPOB = DetailTransactionPPOB::where('transaction_id',$transaction_id)->first();
                $productName = Product::where('id',$dataPPOB->product_id)->first()->name;
                $nomorPelanggan = $dataPPOB->nomor_pelanggan;
                return  [
                    'product_name' => $productName,
                    'customer_number' => $nomorPelanggan,
                ];
            }
        }
    }

    public function __construct()
    {
        Xendit::setApiKey("xnd_development_720yPHpZAyEfNzCycBS6I6nnREM6JrieSYS4zdytWdptFMn68JEyEsoBvPYs");
    }

    //    public function createInvoice(Request $request)
    //    {
    //        $param = [
    //            'external_id' =>
    //        ]
    //    }
    public function getTransactionInv(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_inv' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Fetch data failed', 500);
            }

            // $transaction = Transaction::with('detailTransaction.hostelRoom', 'detailTransaction.product', 'historyPoint', 'rating', 'guest', 'bookDate')
            //     ->where('no_inv', $no_inv)
            //     ->where('user_id', $user_id)
            //     ->get();

            $no_inv = $request->input('no_inv');
            // $user_id = $request->user()->id;
            $user_id = 5;

            $transaction = Transaction::where('no_inv', $no_inv)->where('user_id', $user_id);

            // UNTUK PPOB
            if (in_array($transaction->firstOrFail()->service_id, [1, 6, 3, 5, 9, 10])) {
                $detailTransaction = Transaction::join('detail_transaction_ppob', 'detail_transaction_ppob.transaction_id', '=', 'transactions.id');

                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
                    return [
                        'id' => $detailTransaction->id,
                        'no_inv' => $detailTransaction->no_inv,
                        'nomor_pelanggan' => $detailTransaction->nomor_pelanggan,
                        'req_id' => $detailTransaction->req_id,
                        'link' => $detailTransaction->link,
                        'service' => $detailTransaction->service,
                        'payment' => $detailTransaction->payment,
                        'payment_method' => $detailTransaction->payment_method,
                        'payment_channel' => $detailTransaction->payment_channel,
                        'status' => $detailTransaction->status,
                        'total' => $detailTransaction->total,
                        'created_at' => $detailTransaction->created_at,
                    ];
                });
            }

            // UNTUK TOP UP
            if (in_array($transaction->firstOrFail()->service_id, [1, 2])) {
                $detailTransaction = Transaction::join('detail_transaction_top_up', 'detail_transaction_top_up.transaction_id', '=', 'transactions.id');

                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
                    return [
                        'id' => $detailTransaction->id,
                        'no_inv' => $detailTransaction->no_inv,
                        'nomor_telfon' => $detailTransaction->nomor_telfon,
                        'req_id' => $detailTransaction->req_id,
                        'link' => $detailTransaction->link,
                        'service' => $detailTransaction->service,
                        'payment' => $detailTransaction->payment,
                        'payment_method' => $detailTransaction->payment_method,
                        'payment_channel' => $detailTransaction->payment_channel,
                        'status' => $detailTransaction->status,
                        'total' => $detailTransaction->total,
                        'created_at' => $detailTransaction->created_at,
                    ];
                });
            }

            // UNTUK HOTEL
            if (in_array($transaction->firstOrFail()->service_id, [8])) {
                $detailTransaction = Transaction::join('detail_transaction_hotel', 'detail_transaction_hotel.transaction_id', '=', 'transactions.id')
                    ->join('hotels', 'hotels.id', '=', 'detail_transaction_hotel.hotel_id')
                    ->join('hotel_rooms', 'hotel_rooms.id', '=', 'detail_transaction_hotel.hotel_room_id');

                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
                    return [
                        'id' => $detailTransaction->id,
                        'no_inv' => $detailTransaction->no_inv,
                        'booking_id' => $detailTransaction->booking_id,
                        'reservation_start' => $detailTransaction->reservation_start,
                        'reservation_end' => $detailTransaction->reservation_end,
                        'guest' => $detailTransaction->guest,
                        'room' => $detailTransaction->room,
                        'req_id' => $detailTransaction->req_id,
                        'link' => $detailTransaction->link,
                        'service' => $detailTransaction->service,
                        'payment' => $detailTransaction->payment,
                        'payment_method' => $detailTransaction->payment_method,
                        'payment_channel' => $detailTransaction->payment_channel,
                        'status' => $detailTransaction->status,
                        'total' => $detailTransaction->total,
                        'created_at' => $detailTransaction->created_at,
                    ];
                });
            }

            // UNTUK HOSTEL
            if (in_array($transaction->firstOrFail()->service_id, [7])) {
                $detailTransaction = Transaction::join('detail_transaction_hostel', 'detail_transaction_hostel.transaction_id', '=', 'transactions.id')
                    ->join('hostels', 'hostels.id', '=', 'detail_transaction_hostel.hostel_id')
                    ->join('hostel_rooms', 'hostel_rooms.id', '=', 'detail_transaction_hostel.hostel_room_id');

                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
                    return [
                        'id' => $detailTransaction->id,
                        'no_inv' => $detailTransaction->no_inv,
                        'booking_id' => $detailTransaction->booking_id,
                        'reservation_start' => $detailTransaction->reservation_start,
                        'reservation_end' => $detailTransaction->reservation_end,
                        'guest' => $detailTransaction->guest,
                        'room' => $detailTransaction->room,
                        'type_rent' => $detailTransaction->type_rent,
                        'req_id' => $detailTransaction->req_id,
                        'link' => $detailTransaction->link,
                        'service' => $detailTransaction->service,
                        'payment' => $detailTransaction->payment,
                        'payment_method' => $detailTransaction->payment_method,
                        'payment_channel' => $detailTransaction->payment_channel,
                        'status' => $detailTransaction->status,
                        'total' => $detailTransaction->total,
                        'created_at' => $detailTransaction->created_at,
                    ];
                });
            }


            return ResponseFormatter::success($responseTransaction, 'Data successfully loaded');

            // if (count($transaction)) {
            //     return ResponseFormatter::success($transaction, 'Data successfully loaded');
            // } else {
            //     return ResponseFormatter::error(null, 'Data not found');
            // }
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Fetch data failed', 500);
        }
    }

    public function xenditCallback()
    {
        // Ini akan menjadi Token Verifikasi Callback Anda yang dapat Anda peroleh dari dasbor.
        // Pastikan untuk menjaga kerahasiaan token ini dan tidak mengungkapkannya kepada siapa pun.
        // Token ini akan digunakan untuk melakukan verfikasi pesan callback bahwa pengirim callback tersebut adalah Xendit
        $xenditXCallbackToken = 'c1dda41e2b9371bf8260fe93855a342964a31a0796b16d483702668a49068ce8';
        // Bagian ini untuk mendapatkan Token callback dari permintaan header,
        // yang kemudian akan dibandingkan dengan token verifikasi callback Xendit
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders['X-Callback-Token']) ? $reqHeaders['X-Callback-Token'] : "haloo";
        // Untuk memastikan permintaan datang dari Xendit
        // Anda harus membandingkan token yang masuk sama dengan token verifikasi callback Anda
        // Ini untuk memastikan permintaan datang dari Xendit dan bukan dari pihak ketiga lainnya.
        if ($xIncomingCallbackTokenHeader === $xenditXCallbackToken) {
            // Permintaan masuk diverifikasi berasal dari Xendit

            // Baris ini untuk mendapatkan semua input pesan dalam format JSON teks mentah
            $rawRequestInput = file_get_contents("php://input");
            // Baris ini melakukan format input mentah menjadi array asosiatif
            $arrRequestInput = json_decode($rawRequestInput, true);
            print_r($arrRequestInput);

            $_id = $arrRequestInput['id'];
            $_externalId = $arrRequestInput['external_id'];
            $_userId = $arrRequestInput['user_id'];
            $_status = $arrRequestInput['status'];
            $_paidAmount = $arrRequestInput['paid_amount'];
            $_paidAt = $arrRequestInput['paid_at'];
            $_paymentChannel = $arrRequestInput['payment_channel'];
            $_paymentDestination = $arrRequestInput['payment_destination'];

            // Kamu bisa menggunakan array objek diatas sebagai informasi callback yang dapat digunaka untuk melakukan pengecekan atau aktivas tertentu di aplikasi atau sistem kamu.

        } else {
            // Permintaan bukan dari Xendit, tolak dan buang pesan dengan HTTP status 403
            http_response_code(403);
        }
    }
    public function redirectXenditSucces()
    {
        return ResponseFormatter::success(null, "Transaction Success");
    }
    public function redirectXenditfail()
    {
        return ResponseFormatter::error(null, "Transaction Failed");
    }
}

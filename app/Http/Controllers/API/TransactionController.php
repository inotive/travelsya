<?php

namespace App\Http\Controllers\API;

use DateTime;
use Carbon\Carbon;
use Xendit\Xendit;
use App\Models\Fee;
use App\Models\Hotel;
use App\Models\Hostel;
use App\Models\Product;
use App\Models\HotelRoom;
use App\Models\HostelRoom;
use App\Models\HotelRating;
use App\Models\Transaction;
use App\Models\HistoryPoint;
use App\Models\HostelRating;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransactionPPOB;
use App\Models\DetailTransactionHotel;
use App\Models\DetailTransactionTopUp;
use App\Models\DetailTransactionHostel;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $detailTransaction;


    public function getTransactionUser(Request $request)
    {
        // $user_id = $request->user()->id;
        $user_id = \Auth::user()->id;

        $transaction = Transaction::where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->get();

        $responsTransaction = $transaction->map(function ($transaction) {
            $detailTransaction = $this->getDetailTransaction($transaction->id, $transaction->service_id);
            return [
                'id' => $transaction->id,
                'no_inv' => $transaction->no_inv,
                'req_id' => $transaction->req_id,
                'link' => $transaction->link,
                'service' => $transaction->service,
                'payment' => $transaction->payment,
                'payment_method' => $transaction->payment_method,
                'payment_channel' => $transaction->payment_channel,
                'status' => $transaction->status != "Transaksi Gagal" ? $transaction->status : 'Failed' ,
                'total' => $transaction->total,
                'created_at' => $transaction->created_at,
                'detail_transactions' => $detailTransaction ? $detailTransaction : null,
            ];
        });

        if (count($transaction)) {
            return ResponseFormatter::success($responsTransaction, 'Data successfully loaded');
        } else {
            return ResponseFormatter::success(null, 'Anda Belum Memiliki Transaksi');
        }
        try {
        } catch (\Throwable $th) {
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Fetch data failed', 500);
        }
    }

    protected function getDetailTransaction($transaction_id, $service_id)
    {
        if ($service_id == 7) {
            $data = DetailTransactionHostel::where('transaction_id', $transaction_id)->first();

            if ($data != null) {
                $hostelData = Hostel::where('id', $data->hostel_id)->first();
                $hostelRoom = HostelRoom::where('hostel_id', $hostelData->id)->where('id', $data->hostel_room_id)->first()->name;
                $reservationEnd = Carbon::parse($data->reservation_end);
                $reservationStart = Carbon::parse($data->reservation_start);
                $daysDiff = $reservationEnd->diffInDays($reservationStart);
                return  [
                    'hostel_name' => $hostelData->name,
                    'room_type' => $hostelRoom,
                    'reservation_duration' => $daysDiff,
                ];
            }
        } else if ($service_id == 8) {
            $data = DetailTransactionHotel::where('transaction_id', $transaction_id)->first();
            if ($data) {
                $hotelData = Hotel::where('id', $data->hotel_id)->first();
                $hotelRoom = HotelRoom::where('hotel_id', $hotelData->id)->where('id', $data->hotel_room_id)->pluck('name')->first();
                $reservationEnd = Carbon::parse($data->reservation_end);
                $reservationStart = Carbon::parse($data->reservation_start);
                $daysDiff = $reservationEnd->diffInDays($reservationStart);
                return  [
                    'hotel_name' => $hotelData->name,
                    'room_type' => $hotelRoom,
                    'reservation_duration' => $daysDiff,
                ];
            }
        } else {
            if ($service_id == 1 || $service_id == 11 || $service_id == 12) {
                $dataPulsa = DetailTransactionTopUp::where('transaction_id', $transaction_id)->first();
                if ($dataPulsa) {
                    $nomorTelfon = $dataPulsa->nomor_telfon;
                    $productName = Product::where('id', $dataPulsa->product_id)->first()->name;
                    return  [
                        'product_name' => $productName,
                        'phone_number' => $nomorTelfon,
                    ];
                }
            } else {
                $dataPPOB = DetailTransactionPPOB::where('transaction_id', $transaction_id)->first();
                if ($dataPPOB) {
                    $productName = Product::where('id', $dataPPOB->product_id)->first()->name;
                    $nomorPelanggan = $dataPPOB->nomor_pelanggan;
                    return  [
                        'product_name' => $productName,
                        'customer_number' => $nomorPelanggan,
                    ];
                }
            }
        }
    }

    public function AdminFee()
    {
        $fee = Fee::with('service')->get();
        return response()->json([
            'status' => 200,
            'data' => $fee
        ]);
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
        // return ResponseFormatter::success($request->input('no_inv'), 'Data successfully loaded');
        $validator = Validator::make($request->all(), [
            'no_inv' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'response' => $validator->errors(),
            ], 'Fetch data failed', 500);
        }

        $no_inv = $request->input('no_inv');
        $user_id = $request->user()->id;

        $transaction = Transaction::where('no_inv', $no_inv);
        // dd($transaction->first());
        $historyPoint = collect(HistoryPoint::where('transaction_id', $transaction->first()->id)->get());
        $receivedPoint = $historyPoint->where('flow', 'debit')->pluck('point')->first();
        $usedPoint = $historyPoint->where('flow', 'credit')->pluck('point')->first();
        $responseTransaction = null;
        // UNTUK PPOB
        if (in_array($transaction->first()->service_id, [6, 3, 5, 9, 10])) {
            $detailTransaction = Transaction::join('detail_transaction_ppob', 'detail_transaction_ppob.transaction_id', '=', 'transactions.id')
                ->where('detail_transaction_ppob.transaction_id', $transaction->first()->id)
                ->select('*', 'detail_transaction_ppob.nama_pelanggan')
                ->first();
            $product = Product::where('id', $detailTransaction->product_id)->get();
            $responseTransaction = array([
                'id' => $detailTransaction->id,
                'no_inv' => $detailTransaction->no_inv,
                'nama_pelanggan' => $detailTransaction->nama_pelanggan,
                'nomor_pelanggan' => $detailTransaction->nomor_pelanggan,
                'product' => $product,
                'req_id' => $detailTransaction->req_id,
                'link' => $detailTransaction->link,
                'service' => $detailTransaction->service,
                'payment' => $detailTransaction->payment,
                'payment_method' => $detailTransaction->payment_method,
                'payment_channel' => $detailTransaction->payment_channel,
                'status' => $detailTransaction->status == 'Berhasil' ? 'PAID' : $detailTransaction->status,
                'fee_admin' => $detailTransaction->fee_travelsya + $detailTransaction->kode_unik,
                'total' => $detailTransaction->total,
                'point_received' => $receivedPoint,
                'point_used' => $usedPoint,
                'created_at' => $detailTransaction->created_at,
            ]);
        }

        // UNTUK TOP UP
        if (in_array($transaction->first()->service_id, [1, 2, 11, 12])) {
            $detailTransaction = Transaction::join('detail_transaction_top_up', 'detail_transaction_top_up.transaction_id', '=', 'transactions.id')
                ->where('detail_transaction_top_up.transaction_id', $transaction->first()->id)
                ->first();
            $product = Product::where('id', $detailTransaction->product_id)->get();
            $responseTransaction = array([
                'id' => $detailTransaction->id,
                'no_inv' => $detailTransaction->no_inv,
                'nomor_telfon' => $detailTransaction->nomor_telfon,
                'req_id' => $detailTransaction->req_id,
                'link' => $detailTransaction->link,
                'service' => $detailTransaction->service,
                'product' => $product,
                'payment' => $detailTransaction->payment,
                'payment_method' => $detailTransaction->payment_method,
                'payment_channel' => $detailTransaction->payment_channel,
                'kode_voucher' => $detailTransaction->kode_voucher,
                'status' => $detailTransaction->status == 'Berhasil' ? 'PAID' : $detailTransaction->status,
                'fee_admin' => $detailTransaction->fee_travelsya + $detailTransaction->kode_unik,
                'total' => $detailTransaction->total,
                'point_received' => $receivedPoint,
                'point_used' => $usedPoint,
                'created_at' => $detailTransaction->created_at,
            ]);
            //                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
            //                    return [
            //
            //                    ];
            //                });
        }
        // UNTUK HOTEL
        if (in_array($transaction->first()->service_id, [8])) {
            $detailTransaction = Transaction::join('detail_transaction_hotel', 'detail_transaction_hotel.transaction_id', '=', 'transactions.id')
                ->join('hotels', 'hotels.id', '=', 'detail_transaction_hotel.hotel_id')
                ->join('hotel_rooms', 'hotel_rooms.id', '=', 'detail_transaction_hotel.hotel_room_id')
                ->where('detail_transaction_hotel.transaction_id', $transaction->first()->id)
                ->select(
                    'detail_transaction_hotel.*',
                    'hotels.id  as hotel_id',
                    'hotel_rooms.id  as hotel_room_id',
                    'hotels.name  as hotel_name',
                    'hotel_rooms.name  as hotel_room_name',
                    'transactions.id  as transaksi_id',
                    'transactions.total  as grand_total',
                    'transactions.*',
                )
                ->first();

            $review = HotelRating::where('transaction_id', $transaction->first()->id)->first();

            $responseTransaction = array([
                'id' => $detailTransaction->id,
                'no_inv' => $detailTransaction->no_inv,
                'hotel_id' => $detailTransaction->hotel_id,
                'hotel_room_id' => $detailTransaction->hotel_room_id,
                'hotel_name' => $detailTransaction->hotel_name,
                'hotel_room_name' => $detailTransaction->hotel_room_name,
                'booking_id' => $detailTransaction->booking_id,
                'guest_identity' => array([
                    'name' => $detailTransaction->guest_name,
                    'handphone' => $detailTransaction->guest_email,
                    'email' => $detailTransaction->guest_handphone,
                ]),
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
                'status' => $detailTransaction->status == 'Berhasil' ? 'PAID' : $detailTransaction->status,
                'fee_admin' => $detailTransaction->fee_admin,
                'total' => $detailTransaction->grand_total,
                'received_point' => $receivedPoint,
                'used_point' => $usedPoint,
                'review_hotel' => $review,
                'created_at' => $detailTransaction->created_at,
            ]);
            //                $responseTransaction = collect([$detailTransaction->firstOrFail()])->map(function ($detailTransaction) {
            //                    return [
            //
            //                    ];
            //                });
        }

            // UNTUK HOSTEL
            if (in_array($transaction->first()->service_id, [7])) {
                $detailTransaction = Transaction::join('detail_transaction_hostel', 'detail_transaction_hostel.transaction_id', '=', 'transactions.id')
                    ->join('hostels', 'hostels.id', '=', 'detail_transaction_hostel.hostel_id')
                    ->join('hostel_rooms', 'hostel_rooms.id', '=', 'detail_transaction_hostel.hostel_room_id')
                    ->where('detail_transaction_hostel.transaction_id', $transaction->first()->id)
                    ->select(
                        'detail_transaction_hostel.*',
                        'hostels.id  as hostel_id',
                        'hostel_rooms.id  as hostel_room_id',
                        'hostels.name  as hostel_name',
                        'hostel_rooms.name  as hostel_room_name',
                        'transactions.id  as transaksi_id',
                        'transactions.total  as grand_total',
                        'transactions.*',
                    )
                    ->first();

                    $allRatings = HostelRating::where('transaction_id', $transaction->first()->id)->get();

                    $review = $allRatings->map(function ($item){
                        return [
                            'rate' => $item->rate,
                            'comment' => $item->comment
                        ];

                    });

                    $responseTransaction = array([
                        'id' => $detailTransaction->id,
                        'no_inv' => $detailTransaction->no_inv,
                        'hostel_id' => $detailTransaction->hostel_id,
                        'hostel_room_id' => $detailTransaction->hostel_room_id,
                        'hostel_name' => $detailTransaction->hostel_name,
                        'hotel_room_name' => $detailTransaction->hostel_room_name,
                        'booking_id' => $detailTransaction->booking_id,
                        'guest_identity' => array([
                            'name' => $detailTransaction->guest_name,
                            'handphone' => $detailTransaction->guest_email,
                            'email' => $detailTransaction->guest_handphone,
                        ]),
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
                        'status' => $detailTransaction->status == 'Berhasil' ? 'PAID' : $detailTransaction->status,
                        'fee_admin' => $detailTransaction->fee_admin,
                        'total' => $detailTransaction->grand_total,
                        'received_point' => $receivedPoint,
                        'used_point' => $usedPoint,
                        'review' => $review,
                        'created_at' => $detailTransaction->created_at,

                    ]);
            }



        return ResponseFormatter::success($responseTransaction, 'Data successfully loaded');
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

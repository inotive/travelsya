<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\DetailTransactionHostel;
use App\Models\DetailTransactionHotel;
use App\Models\DetailTransactionPPOB;
use App\Models\HistoryPoint;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Mymili;
use App\Services\Point;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Monolog\Formatter\JsonFormatter;

class CallbackController extends Controller
{
    protected $xendit, $mymili;
    public function __construct(Mymili $mymili, Xendit $xendit)
    {
        $this->xendit = $xendit;
        $this->mymili = $mymili;
    }

    public function Mymili()
    {
    }
    function logReq()
    {
        file_put_contents('xendit.log', file_get_contents('php://input'));
        $fp = fopen('xendit.log', 'a');
        $data = file_get_contents('php://input');
        $json_string = json_encode(json_decode($data), JSON_PRETTY_PRINT);
        fwrite($fp, $json_string);
        fwrite($fp, "\n");
        fclose($fp);
    }

    public function testCheckVoucher(Request $request)
    {
        $data = [
            'reqid' => $request->inv,
            'no_hp' => str($request->kode_pembayaran),
            'nom' => str($request->nomor_telfon),
        ];

        // Tunggu 3 detik agar mili bisa proses transaksinya ke PLN
        sleep(3);
        $transaction = $this->mymili->status($data);
        //process retrieve voucher code
        $responseMessage = explode(' ', $transaction['MESSAGE']);
        $responseMessageSN = explode('SN=', $responseMessage[4]);
        $responseMessageSNCode = explode('/', $responseMessageSN[1]);
        $responseMessageSNCodeFinal = $responseMessageSNCode[0];

        return response()->json([
            '$responseMessage' => $responseMessage,
            '$responseMessageSN' => $responseMessageSN,
            '$responseMessageSNCode' => $responseMessageSNCode,
            '$responseMessageSNCodeFinal' => $responseMessageSNCodeFinal
        ]);
    }
    public function xendit(Request $request)
    {
        $point = new Point();
        // Ini akan menjadi Token Verifikasi Callback Anda yang dapat Anda peroleh dari dasbor.
        // Pastikan untuk menjaga kerahasiaan token ini dan tidak mengungkapkannya kepada siapa pun.
        // Token ini akan digunakan untuk melakukan verfikasi pesan callback bahwa pengirim callback tersebut adalah Xendit
        $xenditXCallbackToken = env('TOKEN_CALLBACK_XENDIT_DEV');

        // Bagian ini untuk mendapatkan Token callback dari permintaan header,
        // yang kemudian akan dibandingkan dengan token verifikasi callback Xendit
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders['X-Callback-Token']) ? $reqHeaders['X-Callback-Token'] : 'Incoming Header belum ada';
        // Untuk memastikan permintaan datang dari Xendit
        // Anda harus membandingkan token yang masuk sama dengan token verifikasi callback Anda
        // Ini untuk memastikan permintaan datang dari Xendit dan bukan dari pihak ketiga lainnya.
        if ($xIncomingCallbackTokenHeader === $xenditXCallbackToken) {
            // Permintaan masuk diverifikasi berasal dari Xendit
            // Baris ini untuk mendapatkan semua input pesan dalam format JSON teks mentah
            $rawRequestInput = file_get_contents('php://input');
            // Baris ini melakukan format input mentah menjadi array asosiatif
            $responseXendit = json_decode($rawRequestInput, true);
            $transaction = Transaction::where('no_inv', $responseXendit['external_id'])
                ->first();
            $settingPoint = new Point();

            if ($transaction) {
                //CEK STATUS PENDING
                if ($transaction->status == 'PENDING') {
                    //PAID
                    if ($responseXendit['status'] == 'PAID') {
                        $status = '';
                        $message = '';
                        $responseCode = '';

                        $transaction->update([
                            'status' => 'PAID',
                            'payment_channel' => $responseXendit['payment_channel'],
                            'payment_method' => $responseXendit['payment_method'],
                        ]);

                        if ($transaction->service == 'pulsa' || $transaction->service == 'listrik-token' || $transaction->service == 'ewallet' || $transaction->service == 'data') {
                            $detailTransactionTopUP = \DB::table('detail_transaction_top_up as top')
                                ->join('products as p', 'top.product_id', '=', 'p.id')
                                ->where('top.transaction_id', $transaction->id)
                                ->select('top.id','top.id','p.kode as kode_pembayaran', 'top.nomor_telfon', 'top.total_tagihan')
                                ->first();
                            $responseMili = $this->mymili->paymentTopUp($transaction->no_inv, str($detailTransactionTopUP->kode_pembayaran), str($detailTransactionTopUP->nomor_telfon));

                            $responseMessageSNCodeFinal = '';
                            if ($transaction->service == 'listrik-token') {
                                $data = [
                                    'reqid' => str($transaction->no_inv),
                                    'no_hp' => str($detailTransactionTopUP->nomor_telfon),
                                    'nom' => str($detailTransactionTopUP->kode_pembayaran),
                                ];
                                print_r($data);
                                // Tunggu 3 detik agar mili bisa proses transaksinya ke PLN
                                sleep(3);
                                $transaction = $this->mymili->status($data);

                                print_r($transaction);

                                if ($transaction['RESPONSECODE'] == 0)
                                {
                                    //process retrieve voucher code
                                    $responseMessage = explode(' ', $transaction['MESSAGE']);
                                    $responseMessageSN = explode('SN=', $responseMessage[4]);
                                    $responseMessageSNCode = explode('/', $responseMessageSN[1]);
                                    $responseMessageSNCodeFinal = $responseMessageSNCode[0];

                                    $response = [
                                        '$responseMessage' => $responseMessage,
                                        '$responseMessageSN' => $responseMessageSN,
                                        '$responseMessageSNCode' => $responseMessageSNCode,
                                        '$responseMessageSNCodeFinal' => $responseMessageSNCodeFinal
                                    ];
                                    print_r($response);
                                }
                            }

                            if ($responseMili['RESPONSECODE'] == 00) {
                                $status = "Berhasil";
                                $message = "Pembayaran " . strtoupper($transaction->service) . ' Berhasil';

                                $pointDiterima = $settingPoint->calculatePoint($detailTransactionTopUP->total_tagihan, $transaction->service_id);
                                print_r($pointDiterima);
                                $user = User::find($transaction->user_id);

                                $user->update(['point' => $user->point + $pointDiterima]);

                                HistoryPoint::create([
                                    'user_id' => $transaction->user_id,
                                    'point' => $pointDiterima,
                                    'transaction_id' => $transaction->id,
                                    'date' => now(),
                                    'flow' => "debit"
                                ]);

                            }
                            elseif ($responseMili['RESPONSECODE'] == 68) {
                                $status = 'Pending';
                                $message = 'Pembayaran Sedang Di Proses';
                                print_r($status);
                            }
                            else {
                                $status = "Transaksi Gagal";
                                $message = "Nomor telfon atau nomor pelanggan tidak dikenali";
                                print_r($status);
                                HistoryPoint::where('transaction_id', $transaction->id)
                                    ->where('flow', 'credit')
                                    ->delete();
                                $transaction->update([
                                    'status' => 'Transaksi Gagal',
                                    'payment_channel' => $responseXendit['payment_channel'],
                                    'payment_method' => $responseXendit['payment_method'],
                                ]);
                            }

                            DB::table('detail_transaction_top_up as top')
                                ->where('top.id', $detailTransactionTopUP->id)
                                ->update([
                                    'status' => $status,
                                    'kode_voucher' => $responseMessageSNCodeFinal,
                                    'updated_at' => Carbon::now()->timezone('Asia/Makassar'),
                                ]);
                        }
                        else if($transaction->service == "pln" || $transaction->service == "pdam" || $transaction->service == "bpjs" || $transaction->service == "tv-internet"){
                            $detailTransactionPPOB = \DB::table('detail_transaction_ppob as ppob')
                                ->join('products as p', 'ppob.product_id', '=', 'p.id')
                                ->select('ppob.id','p.kode as kode_pembayaran', 'ppob.nomor_pelanggan', 'ppob.total_tagihan')
                                ->where('ppob.transaction_id', $transaction->id)
                                ->first();
                            $kode = $detailTransactionPPOB->kode_pembayaran == "CEKTELKOM" ? "PAYTELKOM" : $detailTransactionPPOB->kode_pembayaran;
                            $responseMili =  $this->mymili->paymentPPOB($transaction->no_inv, $kode, $detailTransactionPPOB->nomor_pelanggan);

                            // return $responseMili;
                            if ($responseMili['RESPONSECODE'] == 00) {
                                $status = "Berhasil";
                                $message = "Pembayaran " . $transaction->service . ' Berhasil';

                                $pointDiterima = $settingPoint->calculatePoint($detailTransactionPPOB->total_tagihan, $transaction->service_id);
                                $user = User::find($transaction->user_id);


                                $user->update(['point' => $user->point + $pointDiterima]);

                                HistoryPoint::create([
                                    'user_id' => $transaction->user_id,
                                    'point' => $pointDiterima,
                                    'transaction_id' => $transaction->id,
                                    'date' => now(),
                                    'flow' => "debit"
                                ]);
                            } elseif ($responseMili['RESPONSECODE'] == 68) {
                                $status = 'Pending';
                                $message = 'Pembayaran Sedang Di Proses';
                            } else {
                                $status = 'Transaksi Gagal';
                                $message = 'Pembayaran ' . $transaction->service . ' Gagal';

                                $transaction->update([
                                    'status' => 'Transaksi Gagal',
                                    'payment_channel' => $responseXendit['payment_channel'],
                                    'payment_method' => $responseXendit['payment_method'],
                                ]);
                            }

                            DetailTransactionPPOB::where('transaction_id', $transaction->id)->update([
                                'status' => $status,
                                'message' => $message,
                                'updated_at' => Carbon::now()->timezone('Asia/Makassar'),
                            ]);
                        }
                        else{

                            if ($transaction->service == "hotel" || $transaction->service == "HOTEL")
                            {
                                $status = "Berhasil";
                                $message = "Pemesanan Hotel Berhasil";


//                                $detailHotel = DetailTransactionHotel::where('transaction_id', $transaction->id)->get();
//
                                DetailTransactionHotel::where('transaction_id', $transaction->id)->update([
                                      'updated_at' => Carbon::now()
                                  ]);
//
//                                $startdate = \Carbon\Carbon::parse($detailHotel->reservation_start);
//                                $enddate = \Carbon\Carbon::parse($detailHotel->reservation_end);
//                                $startdates = $startdate->Format('d F Y');
//                                $enddates = $enddate->Format('d F Y');
//                                $diffInDays = $startdate->diffInDays($enddate);
//
//
//                                $grandtotal = $diffInDays * $detailHotel->first()->rent_price * $detailHotel->first()->room;
//
                                $pointDiterima = $settingPoint->calculatePoint($transaction->total, $transaction->service_id);
                                $user = User::find($transaction->user_id);

                                $user->update(['point' => $user->point + $pointDiterima]);

                                HistoryPoint::create([
                                    'user_id' => $transaction->user_id,
                                    'point' => $pointDiterima,
                                    'transaction_id' => $transaction->id,
                                    'date' => now(),
                                    'flow' => "debit"
                                ]);
                            }
                            else{
                                $status = "Berhasil";
                                $message = "Pemesanan Hostel Berhasil";

//                                $detailHostel = DetailTransactionHostel::where('transaction_id', $transaction->id)->get();


                                DetailTransactionHostel::where('transaction_id', $transaction->id)->update([
                                    'updated_at' => Carbon::now()
                                ]);
//                                $startdate = \Carbon\Carbon::parse($detailHostel->reservation_start);
//                                $enddate = \Carbon\Carbon::parse($detailHostel->reservation_end);
//                                $startdates = $startdate->Format('d F Y');
//                                $enddates = $enddate->Format('d F Y');
//                                $diffInDays = $startdate->diffInDays($enddate);
//
//
//                                $grandtotal = $diffInDays * $detailHostel->first()->rent_price * $detailHostel->first()->room;
////
                                $pointDiterima = $settingPoint->calculatePoint($transaction->total, $transaction->service_id);
                                $user = User::find($transaction->user_id);

                                $user->update(['point' => $user->point + $pointDiterima]);

                                HistoryPoint::create([
                                    'user_id' => $transaction->user_id,
                                    'point' => $pointDiterima,
                                    'transaction_id' => $transaction->id,
                                    'date' => now(),
                                    'flow' => "debit"
                                ]);
                            }
                        }



                        if($status == "Berhasil" || $status == "Pending")
                        {

                            return ResponseFormatter::success($status, $message);
                        } else {
                            return ResponseFormatter::error($status, $message);
                        }
                    }
                }
            }
        } else {
            // Permintaan bukan dari Xendit, tolak dan buang pesan dengan HTTP status 403
            http_response_code(403);
        }
    }
    public function XenditOLD(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_TOKEN');
        $json = $request->getContent();

        // dd($callbackSignature, $json);
        if (config('xendit.TOKEN_CALLBACK') !== $callbackSignature) {
            return 'Invalid signature';
        }

        $data = json_decode($json, true);
        $transaction = Transaction::with('detailTransaction.product')
            ->where('no_inv', $data['external_id'])
            ->first();

        // dd($transaction->detailTransaction, $data);
        if ($transaction) {
            //CEK STATUS PENDING
            if ($transaction->status == 'PENDING') {
                //PAID
                if ($data['status'] == 'PAID') {
                    // make trans Mymili
                    foreach ($transaction->detailTransaction as $detail) {
                        if ($transaction->service_id != 7) {
                            if ($detail->no_hp) {
                                $responseMili = $this->mymili->transaction([
                                    'no_hp' => $detail->no_hp,
                                    'nom' => $detail->product->kode,
                                    'reqid' => $transaction->no_inv . '-' . $detail->id,
                                ]);
                                $message = $responseMili['MESSAGE'];
                                // return $responseMili;
                                if ($responseMili['RESPONSECODE'] == 00) {
                                    $status = 'SUCCESS';
                                } elseif ($responseMili['RESPONSECODE'] == 68) {
                                    $status = 'PENDING-PRODUCT';
                                } else {
                                    $status = 'FAILED';
                                }
                            } else {
                                $status = 'FAIL';
                            }
                        } elseif ($transaction->service_id == 7 || $transaction->service_id == 8) {
                            $status = 'SUCCESS';
                            $message = 'SUCCESS HOSTEL';
                        } else {
                            $status = 'FAILED';
                            $message = 'Not found service';
                        }
                        //                        $updateDetail = $transaction->detailTransaction()->find($detail->id)->update([
                        //                            'status' => $status,
                        //                            'message' => $message
                        //                        ]);
                        //                        if (!$updateDetail) {
                        //                            return ResponseFormatter::error(null, "Update DB error");
                        //                        }
                    }
                    $updateTransaction = $transaction->update([
                        'status' => 'PAID',
                        'payment_channel' => $data['payment_channel'],
                        'payment_method' => $data['payment_method'],
                    ]);
                    if (!$updateTransaction) {
                        return ResponseFormatter::error(null, 'Update DB error');
                    }
                    $point = new Point();
                    if (count($data['fees']) == 2) {
                        $feepoint = 0;
                        foreach ($data['fees'] as $fee) {
                            if ($fee['type'] == 'point') {
                                $feepoint = $fee['value'];
                            }
                        }
                        $point->deductPoint($transaction->user_id, abs($feepoint), $transaction->id);
                    } else {
                        $point->addPoint($transaction->user_id, $data['paid_amount'], $transaction->id, $transaction->service_id);
                    }
                } else {
                    if ($transaction->service == 'hostel') {
                        BookDate::where('hostel_room_id', $transaction->detailTransaction['hostel_room_id'])->delete();
                    }
                    if ($transaction->service == 'hotel') {
                        BookDate::where('hotel_room_id', $transaction->detailTransaction['hotel_room_id'])->delete();
                    }
                    //EXPIRED
                    $updateTransaction = $transaction->update([
                        'status' => 'EXPIRED',
                    ]);
                    $updateDetail = $transaction->detailTransaction()->update([
                        'status' => 'EXPIRED',
                    ]);

                    //add back point
                    if (count($data['fees']) > 0) {
                        HistoryPoint::create([
                            'user_id' => $transaction->user_id,
                            'point' => $data['fees'][1]['value'],
                            'transaction_id' => $transaction->id,
                            'date' => now(),
                            'flow' => 'debit',
                        ]);
                        User::find($transaction->user_id)->update(['point' => $data['fees'][1]['value']]);
                    }
                }
            }
        }

        // get xenditi callback
        // get reponse code
        // change status

        // reponse code Mymili
        // 00 Success
        // 14 Failed
        // 30 Failed
        // 68 Pending
        // 99 invalid
    }

    public function callBackPPOB(Request $request)
    {
        $responseMili = $this->mymili->paymentPPOB($request->no_inv, $request->kode_pembayaran, $request->nomor_tagihan);

        if ($responseMili['RESPONSECODE'] == 00) {
            return response()->json([
                'status' => '200',
                'message' => 'Pembayaran telah berhasil',
            ]);
        } elseif ($responseMili['RESPONSECODE'] == 68) {
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sedang diproses',
            ]);
        }
        return response()->json([
            'status' => '400',
            'message' => $responseMili,
        ]);
    }
}

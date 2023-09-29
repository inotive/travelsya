<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BookDate;
use App\Models\HistoryPoint;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Mymili;
use App\Services\Point;
use App\Services\Xendit;
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
        file_put_contents('xendit.log',file_get_contents('php://input'));
        $fp = fopen('xendit.log', 'a');
        $data = file_get_contents('php://input');
        $json_string = json_encode(json_decode($data), JSON_PRETTY_PRINT);
        fwrite($fp, $json_string);
        fwrite($fp, "\n");
        fclose($fp);
    }
    public function xendit(Request $request)
    {

        // Ini akan menjadi Token Verifikasi Callback Anda yang dapat Anda peroleh dari dasbor.
        // Pastikan untuk menjaga kerahasiaan token ini dan tidak mengungkapkannya kepada siapa pun.
        // Token ini akan digunakan untuk melakukan verfikasi pesan callback bahwa pengirim callback tersebut adalah Xendit
        $xenditXCallbackToken = 'c1dda41e2b9371bf8260fe93855a342964a31a0796b16d483702668a49068ce8';

        // Bagian ini untuk mendapatkan Token callback dari permintaan header,
        // yang kemudian akan dibandingkan dengan token verifikasi callback Xendit
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = isset($reqHeaders['X-Callback-Token']) ? $reqHeaders['X-Callback-Token'] : "Incoming Header belum ada";
        // Untuk memastikan permintaan datang dari Xendit
        // Anda harus membandingkan token yang masuk sama dengan token verifikasi callback Anda
        // Ini untuk memastikan permintaan datang dari Xendit dan bukan dari pihak ketiga lainnya.
        if ($xIncomingCallbackTokenHeader === $xenditXCallbackToken) {
            // Permintaan masuk diverifikasi berasal dari Xendit
            // Baris ini untuk mendapatkan semua input pesan dalam format JSON teks mentah
            $rawRequestInput = file_get_contents("php://input");
            // Baris ini melakukan format input mentah menjadi array asosiatif
            $responseXendit = json_decode($rawRequestInput, true);
            print_r($responseXendit);
            $transaction = Transaction::with('detailTransaction.product')
                ->where('no_inv', $responseXendit['external_id'])
                ->first();


            if ($transaction) {
                //CEK STATUS PENDING
                if ($transaction->status == "PENDING") {
                    //PAID
                    if ($responseXendit['status'] == 'PAID') {
                        $status = "";
                        $message = "";
                        $responseCode = "";

                        $transaction->update([
                            'status' => 'Berhasil',
                            'payment_channel' => $responseXendit['payment_channel'],
                            'payment_method' => $responseXendit['payment_method']
                        ]);

                        if($transaction->service == "pulsa")
                        {
                            $detailTransactionTopUP = \DB::table('detail_transaction_top_up as top')
                                ->join('products as p', 'top.product_id', '=', 'p.id')
                                ->where('top.transaction_id', $transaction->id)
                                ->select('top.id','p.kode as kode_pembayaran', 'top.nomor_telfon')
                                ->first();
                            $responseMili =  $this->mymili->paymentTopUp($transaction->no_inv, str($detailTransactionTopUP->kode_pembayaran), str($detailTransactionTopUP->nomor_telfon));

                            if ($responseMili['RESPONSECODE'] == 00) {
                                $status = "Berhasil";
                                $message = "Pembayaran " . strtoupper($transaction->service) . ' Berhasil';
                            } elseif ($responseMili['RESPONSECODE'] == 68) {
                                $status = "Pending";
                                $message = "Pembayaran Sedang Di Proses";
                            } else {
                                $status = "Gagal";
                                $message = "Pembayaran gagal";
                            }

                            DB::table('detail_transaction_top_up')->where('top.id', $detailTransactionTopUP->id)
                                ->update([
                                    'status' => $status,
                                    'message'=> $message
                                ]);

                        }
                        else if($transaction->service == "pln"){
                            $detailTransactionPPOB = \DB::table('detail_transaction_ppob as ppob')
                                ->join('products as p', 'ppob.product_id', '=', 'p.id')
                                ->select('ppob.id','p.kode as kode_pembayaran', 'ppob.nomor_pelanggan')
                                ->where('ppob.transaction_id', $transaction->id)
                                ->first();
                            print_r('sudah masuk pembayaran mili');

                            $responseMili =  $this->mymili->paymentPPOB($transaction->no_inv, $detailTransactionPPOB->kode_pembayaran, $detailTransactionPPOB->nomor_pelanggan);

                            // return $responseMili;
                            if ($responseMili['RESPONSECODE'] == 00) {
                                $status = "Berhasil";
                                $message = "Pembayaran " . $transaction->service . ' Berhasil';
                            } elseif ($responseMili['RESPONSECODE'] == 68) {
                                $status = "Pending";
                                $message = "Pembayaran Sedang Di Proses";
                            } else {
                                $status = "Gagal";
                                $message = "Pembayaran PLN Berhasil";
                            }
                            DB::table('detail_transaction_top_up')->where('top.id', $detailTransactionPPOB->id)
                                ->update([
                                    'status' => $status,
                                    'message'=> $message
                                ]);
                        }
//                        else if($transaction->service == "hotel" || $transaction->service == "hostel"){
//                            $type = $transaction->service;
//                            $detailTransactionPPOB = \DB::table('detail_transaction_hotel as dh')
//                                ->where('dh.transaction_id', $transaction->id)
//                                ->first();
//
//                            if($type == "hotel")
//                            {
//                                DB::table('detail_transaction_hotel')->where('top.id', $detailTransactionPPOB->id)
//                                    ->update([
//                                        'status' => $status,
//                                        'message'=> $message
//                                    ]);
//                            }
//
//                        }

                        if($status == "Berhasil" || $status == "Pending")
                        {
                            return ResponseFormatter::success($status, $message);
                        }
                        else{
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

        $data = json_decode($json, TRUE);
        $transaction = Transaction::with('detailTransaction.product')
            ->where('no_inv', $data['external_id'])
            ->first();

        // dd($transaction->detailTransaction, $data);
        if ($transaction) {
            //CEK STATUS PENDING
            if ($transaction->status == "PENDING") {
                //PAID
                if ($data['status'] == 'PAID') {
                    // make trans Mymili
                    foreach ($transaction->detailTransaction as $detail) {
                        if ($transaction->service_id <> 7) {
                            if ($detail->no_hp) {
                                $responseMili = $this->mymili->transaction([
                                    'no_hp' => $detail->no_hp,
                                    'nom' => $detail->product->kode,
                                    'reqid' => $transaction->no_inv . '-' . $detail->id
                                ]);
                                $message = $responseMili['MESSAGE'];
                                // return $responseMili;
                                if ($responseMili['RESPONSECODE'] == 00) {
                                    $status = "SUCCESS";
                                } elseif ($responseMili['RESPONSECODE'] == 68) {
                                    $status = "PENDING-PRODUCT";
                                } else {
                                    $status = "FAILED";
                                }
                            } else {
                                $status = "FAIL";
                            }
                        } elseif ($transaction->service_id == 7 || $transaction->service_id == 8) {
                            $status = "SUCCESS";
                            $message = "SUCCESS HOSTEL";
                        } else {
                            $status = "FAILED";
                            $message = "Not found service";
                        }
                        $updateDetail = $transaction->detailTransaction()->find($detail->id)->update([
                            'status' => $status,
                            'message' => $message
                        ]);
                        if (!$updateDetail) {
                            return ResponseFormatter::error(null, "Update DB error");
                        }
                    }
                    $updateTransaction = $transaction->update([
                        'status' => 'PAID',
                        'payment_channel' => $data['payment_channel'],
                        'payment_method' => $data['payment_method']
                    ]);
                    if (!$updateTransaction) {
                        return ResponseFormatter::error(null, "Update DB error");
                    }
                    $point = new Point;
                    if (count($data['fees']) == 2) {
                        $feepoint = 0;
                        foreach ($data['fees'] as $fee) {
                            if ($fee['type'] == "point") {
                                $feepoint = $fee['value'];
                            }
                        }
                        $point->deductPoint($transaction->user_id, abs($feepoint), $transaction->id);
                    } else {
                        $point->addPoint($transaction->user_id, $data['paid_amount'], $transaction->id, $transaction->service_id);
                    }
                } else {

                    if ($transaction->service == "hostel") {
                        BookDate::where("hostel_room_id", $transaction->detailTransaction['hostel_room_id'])->delete();
                    }
                    if ($transaction->service == "hotel") {
                        BookDate::where("hotel_room_id", $transaction->detailTransaction['hotel_room_id'])->delete();
                    }
                    //EXPIRED
                    $updateTransaction = $transaction->update([
                        'status' => "EXPIRED"
                    ]);
                    $updateDetail = $transaction->detailTransaction()->update([
                        'status' => "EXPIRED"
                    ]);

                    //add back point
                    if (count($data['fees']) > 0) {
                        HistoryPoint::create([
                            'user_id' => $transaction->user_id,
                            'point' => $data['fees'][1]['value'],
                            'transaction_id' => $transaction->id,
                            'date' => now(),
                            'flow' => "debit"
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

    public function callBackPPOB()
    {
        $responseMili =  $this->mymili->paymentPPOB('test-bayar-dana', 'DNA30', '081253290605');
        if($responseMili['RESPONSECODE'] == 00)
        {
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sudah masuk'
            ]);
        }
        elseif($responseMili['RESPONSECODE'] == 68){
            return response()->json([
                'status' => '200',
                'message' => 'Pulsa sedang diproses'
            ]);
        }
        return response()->json([
            'status' => '400',
            'message' => $responseMili
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Xendit\Xendit;

class TransactionController extends Controller
{
    public function getTransactionUser(Request $request)
    {
        try {
            $user_id = $request->user()->id;

            $transaction = Transaction::with('detailTransaction.hostelRoom', 'detailTransaction.product')
                ->where('user_id', $user_id)
                ->orderBy('id', 'desc')
                ->get();

            if (count($transaction)) {
                return ResponseFormatter::success($transaction, 'Data successfully loaded');
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
            $no_inv = $request->input('no_inv');
            $user_id = $request->user()->id;

            $validator = Validator::make($request->all(), [
                'no_inv' => 'required',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Fetch data failed', 500);
            }

            $transaction = Transaction::with('detailTransaction.hostelRoom', 'detailTransaction.product', 'historyPoint', 'rating', 'guest', 'bookDate')
                ->where('no_inv', $no_inv)
                ->where('user_id', $user_id)
                ->get();

            if (count($transaction)) {
                return ResponseFormatter::success($transaction, 'Data successfully loaded');
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

    public function xenditCallback()
    {
        // Ini akan menjadi Token Verifikasi Callback Anda yang dapat Anda peroleh dari dasbor.
        // Pastikan untuk menjaga kerahasiaan token ini dan tidak mengungkapkannya kepada siapa pun.
        // Token ini akan digunakan untuk melakukan verfikasi pesan callback bahwa pengirim callback tersebut adalah Xendit
        $xenditXCallbackToken = 'c1dda41e2b9371bf8260fe93855a342964a31a0796b16d483702668a49068ce8';
        // Bagian ini untuk mendapatkan Token callback dari permintaan header,
        // yang kemudian akan dibandingkan dengan token verifikasi callback Xendit
        $reqHeaders = getallheaders();
        $xIncomingCallbackTokenHeader = $reqHeaders[0]['X-CALLBACK-TOKEN'];
        return $xIncomingCallbackTokenHeader;
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

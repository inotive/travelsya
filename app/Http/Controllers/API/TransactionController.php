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

    public function xenditCallback(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_TOKEN');
        $json = $request->getContent();


        // dd($callbackSignature, $json);
        if ('c1dda41e2b9371bf8260fe93855a342964a31a0796b16d483702668a49068ce8' !== $callbackSignature) {
            return 'Invalid signature';
        }

        $data = json_decode($json, TRUE);
        return $data;
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

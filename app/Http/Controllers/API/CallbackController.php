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

    public function Xendit(Request $request)
    {
        $responseMili =  $this->mymili->paymentTopUp('inv-test', 'sp15', '081253290605');
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

        return $transaction;
        if ($transaction) {
            //CEK STATUS PENDING
            if ($transaction->status == "PENDING") {
                //PAID
                if ($data['status'] == 'PAID') {
                    $updateTransaction = $transaction->update([
                        'status' => 'Toless',
                        'payment_channel' => $data['payment_channel'],
                        'payment_method' => $data['payment_method']
                    ]);
                    if($transaction->service == "pulsa")
                    {
                        $detailTransactionPulsa = \DB::table('detail_transaction_top_up as top')
                            ->join('product as p', 'top.product_id', '=', 'p.id')
                            ->where('transaction_id', $transaction->id)
                            ->select('p.kode as kode_pembayaran', 'p.kode as nomor_telfon')
                            ->get();


                        DB::table('detail_transaction_top_up')->update([
                            'status' => 'Berhasil',
                            'message'=> $responseMili
                        ]);
                        return $responseMili;
                        if($responseMili['RESPONSECODE'] == 00)
                        {
                            DB::table('detail_transaction_top_up')->update([
                                'status' => 'Berhasil',
                                'message'=> 'Pulsa sudah masuk'
                            ]);
                        }
                        elseif($responseMili['RESPONSECODE'] == 68){
                            DB::table('detail_transaction_top_up')->update([
                                'status' => 'Pending',
                                'message'=> 'Pulsa sedang diproses'
                            ]);
                        }
                    }
                }
            }
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
                                $requestMymili = $this->mymili->transaction([
                                    'no_hp' => $detail->no_hp,
                                    'nom' => $detail->product->kode,
                                    'reqid' => $transaction->no_inv . '-' . $detail->id
                                ]);
                                $message = $requestMymili['MESSAGE'];
                                // return $requestMymili;
                                if ($requestMymili['RESPONSECODE'] == 00) {
                                    $status = "SUCCESS";
                                } elseif ($requestMymili['RESPONSECODE'] == 68) {
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
}

<?php

namespace App\Services;

use App\Helpers\ResponseFormatter;
use App\Models\Fee;
use App\Models\Setting as ModelsSetting;
use App\Models\User;
use Illuminate\Http\Request;

class Setting
{
    public function getAmount($price, $qty, $fees, $room)
    {
        $total = 0;

        $admin = $fees[0]['value'];
        $kodeunik = $fees[1]['value'];

        if (isset($fees[2]['value'])) {
            $point = $fees[2]['value'];
        }
        else{
            $point = 0;
        }
        $total = $price * $qty * $room;
        $grandTotal = $total + $admin + $kodeunik +  $point;
        return $grandTotal;
    }

    public function getFees($point, $service, $userid, $price)
    {
        $fee = Fee::where('service_id', $service)->first();

        if ($fee->percent) {
            $feeValue = $price * ($fee->value / 100);
        } else {
            $feeValue = $fee->value;
        }
        $fees = [];

        array_push($fees, [
            'type' => 'Fee Admin',
            'value' => $feeValue,
            ],
        );

        if (isset($point) && $point != 0) {
            // cek point
            $user = User::find($userid);
            // if ($user && $user->point <= 0) {
            //     return false;
            // }
            array_push($fees, [
                'type' => 'point',
                'value' => 0 - $user->point,
            ]);
        }

        return $fees;
    }
}

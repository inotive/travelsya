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
        $point = 0;
        if (isset($fees[1]['value'])) {
            $point = $fees[1]['value'];
        }
        $total = $price * $qty * $room;
        $grandTotal = $total + $admin + $point + $fees[2]['value'];
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
            'type' => 'admin',
            'value' => $feeValue,
        ]);

        if ($point) {
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

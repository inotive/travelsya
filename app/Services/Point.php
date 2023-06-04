<?php

namespace App\Services;

use App\Models\HistoryPoint;
use App\Models\Point as ModelsPoint;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class Point
{
    public function addPoint($id, $amount, $transid, $categoryid)
    {
        $point = ModelsPoint::where('service_id', $categoryid)->first();

        if ($amount >= $point->multiple) {
            $user = User::find($id);

            $calpoint = $this->calculatePoint($amount, $categoryid);
            $sumpoint = $user->point + $calpoint;
            $user->update(['point' => $sumpoint]);
            HistoryPoint::create([
                'user_id' => $user->id,
                'point' => $calpoint,
                'transaction_id' => $transid,
                'date' => now(),
                'flow' => "debit"
            ]);
        }
    }

    public function deductPoint($id, $point, $transid)
    {
        $user = User::find($id);

        $sumpoint = $user->point - $point;
        $update = $user->update(['point' => $sumpoint < 0 ? 0 : $sumpoint]);

        HistoryPoint::create([
            'user_id' => $user->id,
            'point' => $point,
            'transaction_id' => $transid,
            'date' => now(),
            'flow' => "credit"
        ]);
    }

    public function cekPoint($id)
    {
        $user = User::find($id);

        return $user->point;
    }

    public function calculatePoint($amount, $categoryid)
    {
        $point = ModelsPoint::where('service_id', $categoryid)->first();

        return ($amount / $point->multiple) * $point->value;
    }
}

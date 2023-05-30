<?php

namespace App\Services;

use App\Models\HistoryPoint;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class Point
{
    public function addPoint($id, $amount, $transid)
    {
        $min = Setting::where('category', 'point')->where('name', 'min')->first();

        if ($amount >= $min->vavlue) {
            $user = User::find($id);

            $calpoint = $this->calculatePoint($amount);
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

    public function calculatePoint($amount)
    {
        $point = Setting::where('category', 'point')->where('name', 'point')->first();
        $min = Setting::where('category', 'point')->where('name', 'min')->first();


        if ($amount >= $min->vavlue) return ($amount / $min) * $point->value;
    }
}

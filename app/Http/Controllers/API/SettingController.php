<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Setting;
use App\Services\Mymili;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $mymili, $xendit;
    public function __construct(Mymili $mymili)
    {
        $this->mymili = $mymili;
    }

    // public function getPoint()
    // {
    //     try {
    //         $point = Setting::where('category', 'point')->first();

    //         return ResponseFormatter::success($point, 'Data successfully loaded');
    //     } catch (\Throwable $th) {
    //         return ResponseFormatter::error([
    //             $th,
    //             'message' => 'Something wrong',
    //         ], 'Fetch data failed', 500);
    //     }
    // }

    public function getSaldo()
    {

        $transaction = $this->mymili->saldo();
        if ($transaction['RESPONSECODE'] == 00) {
            return ResponseFormatter::success($transaction, 'Saldo request success');
        } else {
            return ResponseFormatter::error(null, $transaction['MESSAGE']);
        }
    }

    public function getService()
    {
        $service = Service::get();
        if (count($service)) {
            return ResponseFormatter::success($service, 'Service successfully loaded');
        } else {
            return ResponseFormatter::error(null, 'Data not found');
        }
    }
}

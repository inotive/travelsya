<?php

namespace App\Actions\Recretion;

use App\Models\RecreationPackages;
use App\Models\Transaction;
use App\Models\Point;
use App\Models\DetailTransactionRecreation;
use App\Models\Fee;
use App\Models\Service;
use App\Services\Xendit;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateTransaction
{

    public function execute(array $data, $user)
    {
        $package = RecreationPackages::findOrFail($data['package_id']);

        $expire = $this->calculateExpiry($package);

        $invoice = $this->generateInvoice();

        $service = Service::where('name', $data['service'])->firstOrFail();

        $amount = $package->price * $data['total_ticket'];
        $kodeUnik = random_int(0, 999);

        $fees = $this->calculateFees($data, $service, $user, $package, $amount, $kodeUnik);

        $payoutsXendit = $this->createXenditInvoice($invoice, $data, $package, $amount, $fees, $kodeUnik, $user);

        DB::transaction(function () use (
            $data, $expire, $kodeUnik, $invoice, $user, $payoutsXendit, $service, $amount, $fees, $package
        ) {
            $transaction = Transaction::create([
                'no_inv'     => $invoice,
                'req_id'     => 'REC-' . time(),
                'service'    => $data['service'],
                'service_id' => $service->id,
                'payment'    => $data['payment'],
                'user_id'    => $user->id,
                'status'     => $payoutsXendit['status'],
                'link'       => $payoutsXendit['invoice_url'],
                'total'      => $amount + $fees[0]['value'] + $kodeUnik,
            ]);

            if ($data['point'] == 1) {
                (new Point())->deductPoint($user->id, $user->point, $transaction->id);
            }

            try {
                DetailTransactionRecreation::create([
                    'transaction_id'        => $transaction->id,
                    'recreation_id'         => $package->recreation_id,
                    'recreationPackage_id'  => $package->id,
                    'booking_id'            => Str::random(6),
                    'expire_on'             => $expire,
                    'rent_price'            => $package->price,
                    'fee_admin'             => $fees[0]['value'],
                    'total_ticket'          => $data['total_ticket'],
                    'kode_unik'             => $kodeUnik,
                    'is_used'               => 0,
                ]);
            } catch (Throwable $e) {
                // Log error or handle as needed
                throw new \Exception('Error storing detail transaction: ' . $e->getMessage());
            }
        });


        return $payoutsXendit;
    }

    protected function calculateExpiry($package)
    {
        $now = date('Y-m-d');
        if (strtolower($package->expiry_type) === 'hari') {
            return Carbon::parse($now)
                ->addDays($package->expiry_date)
                ->addHours(23)
                ->format('Y-m-d H:i:s');
        }
        return Carbon::now()
            ->addHours($package->expiry_date)
            ->format('Y-m-d H:i:s');
    }

    protected function generateInvoice()
    {
        return 'INV-' . date('Ymd') . '-RECREATION-' . time();
    }

    protected function calculateFees($data, $service, $user, $package, $amount, $kodeUnik)
    {
        if ($data['point'] == 1) {
            return [
                [
                    'type'  => 'Point',
                    'value' => $user->point,
                ],
            ];
        }

        $fee = Fee::where('service_id', 8)->first();
        $adminFee = $fee
            ? ($fee->percent == 0 ? $fee->value : ($amount * $fee->value) / 100)
            : 0;

        return [
            [
                'type'  => 'Admin',
                'value' => $adminFee,
            ],
            [
                'type'  => 'Kode Unik',
                'value' => $kodeUnik,
            ],
        ];
    }

    protected function createXenditInvoice($invoice, $data, $package, $amount, $fees, $kodeUnik, $user)
    {
        return app(Xendit::class)->create([
            'external_id'           => $invoice,
            'items'                 => [
                [
                    'product_id' => $data['package_id'],
                    'name'       => $package->name ?? 'Invalid recreation',
                    'price'      => $amount,
                    'quantity'   => $data['total_ticket'],
                ],
            ],
            'amount'                => $amount + $fees[0]['value'] + $kodeUnik,
            'success_redirect_url'  => route('redirect.succes'),
            'failure_redirect_url'  => route('redirect.fail'),
            'invoice_duration'      => 72000,
            'should_send_email'     => true,
            'customer'              => [
                'given_names'   => $user->name,
                'email'         => $user->email,
                'mobile_number' => $user->phone ?? '000000000000',
            ],
            'fees'                  => $fees,
        ]);
    }
}

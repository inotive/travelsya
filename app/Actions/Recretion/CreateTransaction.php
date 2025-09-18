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
        \Log::info('CreateTransaction execute started', [
            'user_id' => $user->id,
            'package_id' => $data['package_id'],
            'paket_data' => $data['paket']
        ]);

        $package = RecreationPackages::findOrFail($data['package_id']);
        \Log::info('Package found', ['package_id' => $package->id, 'package_name' => $package->name]);

        $expire = $this->calculateExpiry($package);
        \Log::info('Expiry calculated', ['expire_date' => $expire]);

        $invoice = $this->generateInvoice();
        \Log::info('Invoice generated', ['invoice' => $invoice]);

        $service = RecreationPackages::whereIn('id', array_column($data['paket'], 'paket_id'))->get();

        // Hitung total harga berdasarkan paket yang dipilih
        $amount = 0;
        $totalTicket = 0;
        foreach ($data['paket'] as $paket) {
            $paketModel = $service->firstWhere('id', $paket['paket_id']);
            if ($paketModel) {
                $amount += $paketModel->price * $paket['total'];
                $totalTicket += $paket['total'];
            }

            $xenditData[] = [
                'id' => $paketModel->id,
                'name'       => $paketModel->name,
                'price'      => $paketModel->price * $paket['total'],
                'quantity'   => $paket['total'],
            ];
        }

        \Log::info('Amount calculated', ['total_amount' => $amount, 'total_tickets' => $totalTicket]);

        $kodeUnik = random_int(0, 999);
        \Log::info('Unique code generated', ['kode_unik' => $kodeUnik]);

        $fees = $this->calculateFees($data, $service, $user, $package, $amount, $kodeUnik);
        \Log::info('Fees calculated', ['fees' => $fees]);

        $payoutsXendit = $this->createXenditInvoice($invoice, $xenditData, $package, $amount, $fees, $kodeUnik, $user);
        \Log::info('Xendit invoice created', ['xendit_response' => $payoutsXendit]);

        DB::transaction(function () use (
            $data,
            $expire,
            $kodeUnik,
            $invoice,
            $user,
            $payoutsXendit,
            $service,
            $amount,
            $fees,
            $package
        ) {
            \Log::info('Starting database transaction');

            $transaction = Transaction::create([
                'no_inv'     => $invoice,
                'req_id'     => 'REC-' . time(),
                'service'    => "Recreation",
                'service_id' => 1,
                'payment'    => $data['payment'],
                'user_id'    => $user->id,
                'status'     => $payoutsXendit['status'],
                'link'       => $payoutsXendit['invoice_url'],
                'total'      => $amount + $fees[0]['value'] + $kodeUnik,
            ]);

            \Log::info('Transaction created', ['transaction_id' => $transaction->id]);

            if ($data['point'] == 1) {
                \Log::info('Deducting points', ['user_id' => $user->id, 'points' => $user->point]);
                (new Point())->deductPoint($user->id, $user->point, $transaction->id);
            }

            try {
                foreach ($data['paket'] as $paket) {
                    $detailTransaction = DetailTransactionRecreation::create([
                        'transaction_id'        => $transaction->id,
                        'recreation_id'         => $package->recreation_id,
                        'recreationPackage_id'  => $package->id,
                        'booking_id'            => Str::random(6),
                        'expire_on'             => $expire,
                        'rent_price'            => $package->price,
                        'fee_admin'             => $fees[0]['value'],
                        'total_ticket'          => $paket['total'],
                        'kode_unik'             => $kodeUnik,
                        'is_used'               => 0,
                    ]);

                    \Log::info('Detail transaction created', [
                        'detail_id' => $detailTransaction->id,
                        'booking_id' => $detailTransaction->booking_id
                    ]);
                }
            } catch (Throwable $e) {
                \Log::error('Error storing detail transaction', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw new \Exception('Error storing detail transaction: ' . $e->getMessage());
            }

            \Log::info('Database transaction completed successfully');
        });

        \Log::info('CreateTransaction execute completed successfully', ['invoice' => $invoice]);
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
            'items'                 => $data,
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

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HealthBeautyTransaction;
use App\Models\User;
use App\Models\HealthBeautyPackage;
use Carbon\Carbon;

class HealthBeautyTransactionSeeder extends Seeder
{
    public function run()
    {
        $users = User::limit(5)->get();
        $packages = HealthBeautyPackage::all();

        if ($users->isEmpty() || $packages->isEmpty()) {
            $this->command->info('Tidak dapat membuat transaksi. Pastikan ada user dan package terlebih dahulu.');
            return;
        }

        $statuses = ['pending', 'paid', 'paid', 'paid', 'failed'];
        
        foreach ($users as $user) {
            foreach ($packages as $package) {
                $purchaseDate = Carbon::now()->subDays(rand(0, 60));
                $expiryDate = $purchaseDate->copy()->addDays($package->validity_days);
                
                HealthBeautyTransaction::create([
                    'transaction_code' => 'HB-' . strtoupper(uniqid()),
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'total_price' => $package->price,
                    'payment_status' => $statuses[array_rand($statuses)],
                    'purchase_date' => $purchaseDate,
                    'expiry_date' => $expiryDate,
                    'notes' => 'Transaksi contoh untuk testing'
                ]);
            }
        }

        $this->command->info('Berhasil membuat transaksi health & beauty contoh.');
    }
}
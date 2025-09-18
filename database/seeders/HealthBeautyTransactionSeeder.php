<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ClinicHasPackages;
use App\Models\DetailTransactionHealthBeauty;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HealthBeautyTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partnerUser = User::firstOrCreate(
            ['email' => 'mitra@gmail.com'],
            [
                'name' => 'Mitra Travelsya',
                'password' => Hash::make('password'),
                'role' => 1, // Role for Mitra
                'point' => 0,
                'is_active' => 1,
            ]
        );

        $customers = [];
        for ($i = 0; $i < 5; $i++) {
            $customers[] = User::firstOrCreate(
                ['email' => 'customer' . ($i + 1) . '@example.com'],
                [
                    'name' => 'Customer ' . ($i + 1),
                    'password' => Hash::make('password'),
                    'phone' => '08123456789' . $i,
                    'point' => 0,
                    'role' => 2, // Role for Customer
                    'is_active' => 1,
                ]
            );
        }

        $this->seedHealthBeautyBookings($partnerUser, $customers);
    }

    private function seedHealthBeautyBookings($partnerUser, $customers)
    {
        // Create or find a Health & Beauty provider
        $clinic = Clinic::firstOrCreate(
            ['clinic_name' => 'Klinik Kecantikan Glow Up'],
            [
                'user_id' => $partnerUser->id,
                'city' => 'Jakarta',
                'address' => 'Jl. Kecantikan No. 10',
                'phone' => '081234567899',
                'is_active' => true,
            ]
        );

        // Create a package
        $package = ClinicHasPackages::firstOrCreate(
            [
                'clinic_id' => $clinic->id,
                'name' => 'Facial Express + Masker',
            ],
            [
                'categories_services_id' => 1,
                'specialist_id' => 1,
                'rules' => 'Tidak ada aturan khusus',
                'description' => 'Perawatan wajah cepat untuk kulit glowing',
                'duration' => 45,
                'duration_type' => 'menit',
                'expiry_date' => 30,
                'unit_price' => '150000',
                'price' => 150000,
                'is_active' => true,
            ]
        );

        // Create 5 bookings
        foreach ($customers as $key => $customer) {
            $booking_id = 'BOOK-HB-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-HB-' . $booking_id],
                [
                    'user_id' => $customer->id,
                    'service' => 'HealthBeauty',
                    'service_id' => 3,
                    'payment' => 'onthespot',
                    'total' => 155000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionHealthBeauty::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'clinic_id' => $clinic->id,
                    'clinic_package_id' => $package->id,
                    'category' => 1,
                    'expire_on' => Carbon::now()->addDays(30 + $key),
                    'rent_price' => 150000,
                    'total_ticket' => 1,
                    'fee_admin' => 5000,
                    'kode_unik' => rand(100, 999),
                    'is_used' => 0,
                ]
            );
        }
    }
}

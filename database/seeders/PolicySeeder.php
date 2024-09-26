<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policy::create([
            'car_rental_id' => 2,
            'name' => 'Policy 1',
            'description' => 'Jika Anda membatalkan pemesanan Anda dalam waktu 24 jam sebelum pengambilan, Anda akan dikenakan biaya 50% dari total biaya sewa.',
        ]);

        Policy::create([
            'car_rental_id' => 3,
            'name' => 'Contoh Policy',
            'description' => 'Jika Anda membatalkan pemesanan Anda dalam waktu 24 jam sebelum pengambilan, Anda akan dikenakan biaya 50% dari total biaya sewa.',
        ]);

        Policy::create([
            'car_rental_id' => 2,
            'name' => 'Policy 3',
            'description' => 'Jika Anda membatalkan pemesanan Anda dalam waktu 48 jam sebelum pengambilan, Anda akan dikenakan biaya 25% dari total biaya sewa.',
        ]);

        Policy::create([
            'car_rental_id' => 3,
            'name' => 'Policy 4',
            'description' => 'Jika Anda membatalkan pemesanan Anda dalam waktu 72 jam sebelum pengambilan, Anda akan dikenakan biaya 10% dari total biaya sewa.',
        ]);

        Policy::create([
            'car_rental_id' => 3,
            'name' => 'Policy 5',
            'description' => 'Jika Anda membatalkan pemesanan Anda dalam waktu 1 minggu sebelum pengambilan, Anda akan dikenakan biaya 5% dari total biaya sewa.',
        ]);

    }
}

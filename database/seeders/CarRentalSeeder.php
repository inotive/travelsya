<?php

namespace Database\Seeders;

use App\Models\CarRental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarRentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarRental::create([
            'user_id' => 1,
            'business_name' => 'Sewa Mobil Rama',
            'phone' => '081234567890',
            'city' => 'Yogyakarta',
            'address' => 'Jl. Parangtritis No. 123',
            'is_active' => true,
        ]);

        CarRental::create([
            'user_id' => 2,
            'business_name' => 'Sewa Mobil Jaya',
            'phone' => '081234567890',
            'city' => 'Solo',
            'address' => 'Jl. Slamet Riyadi No. 456',
            'is_active' => true,
        ]);

        CarRental::create([
            'user_id' => 3,
            'business_name' => 'Sewa Mobil Sakti',
            'phone' => '081234567890',
            'city' => 'Semarang',
            'address' => 'Jl. Pemuda No. 789',
            'is_active' => true,
        ]);

        CarRental::create([
            'user_id' => 4,
            'business_name' => 'Sewa Mobil Perdana',
            'phone' => '081234567890',
            'city' => 'Surabaya',
            'address' => 'Jl. Tunjungan No. 234',
            'is_active' => true,
        ]);

        CarRental::create([
            'user_id' => 5,
            'business_name' => 'Sewa Mobil Maju',
            'phone' => '081234567890',
            'city' => 'Jakarta',
            'address' => 'Jl. Urip Sumoharjo No. 901',
            'is_active' => true,
        ]);

    }
}

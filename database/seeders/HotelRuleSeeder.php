<?php

namespace Database\Seeders;

use App\Models\HotelRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelRule::create([
            'id' => 3,
            'hotel_id' => 2,
            'description' => 'No Smoking',
            'created_at' => '2023-10-15 18:14:27',
            'updated_at' => '2023-10-15 18:14:27',
        ]);
        HotelRule::create([
            'id' => 4,
            'hotel_id' => 6,
            'description' => 'No Smoking',
            'created_at' => '2023-10-17 21:12:09',
            'updated_at' => '2023-10-17 21:12:09',
        ]);
        HotelRule::create([
            'id' => 5,
            'hotel_id' => 6,
            'description' => 'Jagalah Kebersihan Kamar dan Sekitar Hotel',
            'created_at' => '2023-10-17 21:15:20',
            'updated_at' => '2023-10-17 21:15:53',
        ]);
        HotelRule::create([
            'id' => 6,
            'hotel_id' => 7,
            'description' => 'Tidak diperbolehkan membawa hewan peliharaan',
            'created_at' => '2023-10-18 10:15:20',
            'updated_at' => '2023-10-18 10:15:53',
        ]);
        HotelRule::create([
            'id' => 7,
            'hotel_id' => 7,
            'description' => 'Tidak diperbolehkan mengadakan pesta',
            'created_at' => '2023-10-18 10:20:20',
            'updated_at' => '2023-10-18 10:20:53',
        ]);
    }
}

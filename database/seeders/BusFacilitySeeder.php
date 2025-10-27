<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusFacility;

class BusFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'TV LED'
            ],
            [
                'name' => 'Toilet'
            ],
            [
                'name' => 'Bagasi Bawah'
            ],
            [
                'name' => 'Rak Bagasi Atas'
            ],
            [
                'name' => 'Selimut dan Bantal'
            ],
            [
                'name' => 'Wi-Fi'
            ],
        ];

        foreach ($items as $item) {
            BusFacility::create($item);
        }
    }
}

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
            [
                'name' => 'AC'
            ],
            [
                'name' => 'Stop Kontak'
            ],
            [
                'name' => 'Charger USB'
            ],
            [
                'name' => 'Recliner Seat'
            ],
            [
                'name' => 'Snack'
            ],
            [
                'name' => 'Air Mineral'
            ],
            [
                'name' => 'Bantal dan Guling'
            ],
            [
                'name' => 'Karaoke'
            ],
            [
                'name' => 'Audio Player'
            ],
        ];

        foreach ($items as $item) {
            // Cek apakah fasilitas sudah ada, jika belum maka tambahkan
            BusFacility::firstOrCreate(
                ['name' => $item['name']], // kondisi pencarian
                $item // data yang akan diisi jika belum ada
            );
        }
    }
}

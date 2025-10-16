<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BusTravelHasBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the 'kategori' and 'deskripsi' columns exist in the table
        $hasKategori = Schema::hasColumn('bus_travel_has_buses', 'kategori');
        $hasDeskripsi = Schema::hasColumn('bus_travel_has_buses', 'deskripsi');

        // Prepare base data that always exists
        $baseData1 = [
            'bus_travel_id' => 1,
            'tos' => 'No rokok',
            'name' => 'NPM Solok Padang',
            'number_seats' => 40,
            'class' => 'Executive (subclass C)',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ];

        // Add conditional fields if they exist in the table
        if ($hasKategori) {
            $baseData1['kategori'] = 'bus'; // or 'travel'
        }
        if ($hasDeskripsi) {
            $baseData1['deskripsi'] = 'Executive bus service with comfortable seating and amenities';
        }

        DB::table('bus_travel_has_buses')->insert($baseData1);

        // Prepare base data for second entry
        $baseData2 = [
            'bus_travel_id' => 1,
            'tos' => 'No rokok',
            'name' => 'NPM Jakarta Bandung',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ];

        if ($hasKategori) {
            $baseData2['kategori'] = 'bus'; // or 'travel'
        }
        if ($hasDeskripsi) {
            $baseData2['deskripsi'] = 'Economy bus service with basic amenities';
        }

        DB::table('bus_travel_has_buses')->insert($baseData2);

        // Prepare base data for third entry
        $baseData3 = [
            'bus_travel_id' => 2,
            'tos' => 'No rokok',
            'name' => 'AWR Padang Bukittinggi',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ];

        if ($hasKategori) {
            $baseData3['kategori'] = 'travel'; // or 'bus'
        }
        if ($hasDeskripsi) {
            $baseData3['deskripsi'] = 'Economy travel service connecting Padang and Bukittinggi';
        }

        DB::table('bus_travel_has_buses')->insert($baseData3);

        // Prepare base data for fourth entry
        $baseData4 = [
            'bus_travel_id' => 2,
            'tos' => 'No rokok',
            'name' => 'AWR Jakarta Bandung',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ];

        if ($hasKategori) {
            $baseData4['kategori'] = 'travel'; // or 'bus'
        }
        if ($hasDeskripsi) {
            $baseData4['deskripsi'] = 'Economy travel service connecting Jakarta and Bandung';
        }

        DB::table('bus_travel_has_buses')->insert($baseData4);
    }
}

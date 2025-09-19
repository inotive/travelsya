<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusTravelHasBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bus_travel_has_buses')->insert([
            'bus_travel_id' => 1,
            'tos' => 'No rokok',
            'name' => 'NPM Solok Padang',
            'number_seats' => 40,
            'class' => 'Executive (subclass C)',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ]);

        DB::table('bus_travel_has_buses')->insert([
            'bus_travel_id' => 1,
            'tos' => 'No rokok',
            'name' => 'NPM Jakarta Bandung',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ]);

        DB::table('bus_travel_has_buses')->insert([
            'bus_travel_id' => 2,
            'tos' => 'No rokok',
            'name' => 'AWR Padang Bukittinggi',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ]);

        DB::table('bus_travel_has_buses')->insert([
            'bus_travel_id' => 2,
            'tos' => 'No rokok',
            'name' => 'AWR Jakarta Bandung',
            'number_seats' => 35,
            'class' => 'Ekonomi',
            'is_active' => 1,
            'image' => 'images/not_found.jpg',
        ]);
    }
}

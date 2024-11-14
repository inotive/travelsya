<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bus_routes')->insert([
            'name' => 'PADANG'
        ]);
        DB::table('bus_routes')->insert([
            'name' => 'BUKITTINGGI'
        ]);
        DB::table('bus_routes')->insert([
            'name' => 'JAKARTA'
        ]);
        DB::table('bus_routes')->insert([
            'name' => 'BANDUNG'
        ]);
    }
}

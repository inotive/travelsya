<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusDepartureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 1,
            'departure_time' => '05:30',
            'from_route_id' => 2,
            'to_route_id' => 1,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 1,
            'departure_time' => '10:00',
            'from_route_id' => 1,
            'to_route_id' => 2,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 2,
            'departure_time' => '06:00',
            'from_route_id' => 3,
            'to_route_id' => 4,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 2,
            'departure_time' => '13:00',
            'from_route_id' => 4,
            'to_route_id' => 3,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 3,
            'departure_time' => '05:00',
            'from_route_id' => 2,
            'to_route_id' => 1,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 3,
            'departure_time' => '08:30',
            'from_route_id' => 1,
            'to_route_id' => 2,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 4,
            'departure_time' => '08:30',
            'from_route_id' => 3,
            'to_route_id' => 4,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);

        DB::table('bus_departures')->insert([
            'bus_travel_has_bus_id' => 4,
            'departure_time' => '15:00',
            'from_route_id' => 4,
            'to_route_id' => 3,
            'duration' => null,
            'days' => '[senin, selasa, rabu, kamis, jumat, sabtu, minggu]'
        ]);
    }
}

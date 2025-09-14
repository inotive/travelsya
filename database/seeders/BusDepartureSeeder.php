<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\BusRoute;

class BusDepartureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all cities to check against
        $cities = City::pluck('city_name', 'id')->toArray();
        
        // Function to ensure city exists in bus_route table
        $ensureCityInBusRoute = function($cityId) use ($cities) {
            if (isset($cities[$cityId])) {
                $cityName = $cities[$cityId];
                // Check if city already exists in bus_route
                $existingRoute = BusRoute::where('name', $cityName)->first();
                if (!$existingRoute) {
                    // Add city to bus_route if it doesn't exist
                    BusRoute::create(['name' => $cityName]);
                }
            }
        };

        // Sample departure data
        $departures = [
            [
                'bus_travel_has_bus_id' => 1,
                'departure_time' => '05:30',
                'from_city_id' => 2,
                'to_city_id' => 1,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'departure_time' => '10:00',
                'from_city_id' => 1,
                'to_city_id' => 2,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 2,
                'departure_time' => '06:00',
                'from_city_id' => 3,
                'to_city_id' => 4,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 2,
                'departure_time' => '13:00',
                'from_city_id' => 4,
                'to_city_id' => 3,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 3,
                'departure_time' => '05:00',
                'from_city_id' => 2,
                'to_city_id' => 1,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 3,
                'departure_time' => '08:30',
                'from_city_id' => 1,
                'to_city_id' => 2,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 4,
                'departure_time' => '08:30',
                'from_city_id' => 3,
                'to_city_id' => 4,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ],
            [
                'bus_travel_has_bus_id' => 4,
                'departure_time' => '15:00',
                'from_city_id' => 4,
                'to_city_id' => 3,
                'duration' => null,
                'days' => 'senin,selasa,rabu,kamis,jumat,sabtu,minggu',
                'price' => 100000,
                'titik_naik' => 'Terminal Default',
                'titik_turun' => 'Terminal Default'
            ]
        ];

        // Insert departures and ensure cities are in bus_route
        foreach ($departures as $departure) {
            // Ensure both from and to cities exist in bus_route
            $ensureCityInBusRoute($departure['from_city_id']);
            $ensureCityInBusRoute($departure['to_city_id']);
            
            // Insert the departure
            DB::table('bus_departures')->insert($departure);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\BusRoute;

class BusDepartureSeeder extends Seeder
{
    private $cities;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all cities to check against
        $this->cities = City::pluck('city_name', 'id')->toArray();

        // Sample departure data
        $departures = [
            [
                'bus_travel_has_bus_id' => 1,
                'departure_time' => '05:30',
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
                'departure_date' => '2025-10-01', // Set to October 1, 2025
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
            $this->ensureCityInBusRoute($departure['from_city_id']);
            $this->ensureCityInBusRoute($departure['to_city_id']);
            
            // Insert the departure
            DB::table('bus_departures')->insert($departure);
        }
    }

    /**
     * Ensures that a city exists in the bus_route table.
     *
     * @param int $cityId
     * @return void
     */
    private function ensureCityInBusRoute(int $cityId): void
    {
        if (isset($this->cities[$cityId])) {
            $cityName = $this->cities[$cityId];
            // Find the route by name or create it if it doesn't exist.
            BusRoute::firstOrCreate(['name' => $cityName]);
        }
    }
}
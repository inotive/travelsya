<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Province::all();

        foreach ($provinces as $province) {
            $url = 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $province->prov_id . '.json';
            $json = file_get_contents($url);
            $cities = json_decode($json, true);

            foreach ($cities as $cityData) {
                City::updateOrCreate(
                    ['city_id' => $cityData['id']],
                    [
                        'city_name' => $cityData['name'],
                        'prov_id' => $province->id,
                        'status' => '1',
                        'image' => '-'
                    ]
                );
            }
        }
    }
}

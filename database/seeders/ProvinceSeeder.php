<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dari API
        $url = 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json';
        $json = file_get_contents($url);
        $provinces = json_decode($json, true);

        // Masukkan setiap provinsi ke dalam database
        foreach ($provinces as $provinceData) {
            Province::updateOrCreate(
                ['prov_id' => $provinceData['id']],
                [
                    'prov_name' => $provinceData['name'],
                    'locationid' => 1, 
                    'status' => '1'
                ]
            );
        }
    }
}

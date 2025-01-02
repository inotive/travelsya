<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarModel::create([
            'brand_id' => 1,
            'name' => 'Fiesta'
        ]);

        CarModel::create([
            'brand_id' => 1,
            'name' => 'Focus'
        ]);

        CarModel::create([
            'brand_id' => 1,
            'name' => 'Mustang'
        ]);

        CarModel::create([
            'brand_id' => 2,
            'name' => 'Avanza'
        ]);

        CarModel::create([
            'brand_id' => 2,
            'name' => 'Agya'
        ]);

        CarModel::create([
            'brand_id' => 2,
            'name' => 'Yaris'
        ]);

        CarModel::create([
            'brand_id' => 3,
            'name' => 'Grand Avega'
        ]);

        CarModel::create([
            'brand_id' => 3,
            'name' => 'i10'
        ]);

        CarModel::create([
            'brand_id' => 3,
            'name' => 'Stargazer'
        ]);

        CarModel::create([
            'brand_id' => 4,
            'name' => 'Brio'
        ]);

        CarModel::create([
            'brand_id' => 4,
            'name' => 'City'
        ]);

        CarModel::create([
            'brand_id' => 4,
            'name' => 'Jazz'
        ]);

        CarModel::create([
            'brand_id' => 5,
            'name' => 'Pajero Sports'
        ]);

        CarModel::create([
            'brand_id' => 5,
            'name' => 'Xpander'
        ]);

        CarModel::create([
            'brand_id' => 5,
            'name' => 'Outlander'
        ]);
    }
}

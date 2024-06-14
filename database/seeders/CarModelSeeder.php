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
            'name' => 'Ford'
        ]);

        CarModel::create([
            'name' => 'Toyota'
        ]);

        CarModel::create([
            'name' => 'Hyundai'
        ]);


    }
}

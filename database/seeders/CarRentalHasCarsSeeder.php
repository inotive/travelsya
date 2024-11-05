<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\CarRental;
use Illuminate\Database\Seeder;
use App\Models\CarRentalHasCars;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarRentalHasCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarRentalHasCars::create([
            'car_rental_id' => 5,
            'brand_id' => 5,
            'car_model_id' => 2,
            'policy_id' => 1,
            'number_seats' => 4,
            'category_rent' => 'Dengan Driver',
            'Category' => 'manual',
            'rental_price_per_day' => 500000,
            'duration' => '2 Hari',
            'status' => '1',
            'description' => 'Jangan menyakiti',
            'image_url' => null,
            'years' => '2017',
        ]);

        CarRentalHasCars::create([
            'car_rental_id' => 3,
            'brand_id' => 2,
            'car_model_id' => 3,
            'policy_id' => 1,
            'number_seats' => 4,
            'category_rent' => 'Dengan Driver',
            'Category' => 'automatic',
            'rental_price_per_day' => 500000,
            'duration' => '2 Hari',
            'status' => '1',
            'description' => 'Jangan menyakiti',
            'image_url' => null,
            'years' => '2018',
        ]);

        CarRentalHasCars::create([
            'car_rental_id' => 1,
            'brand_id' => 1,
            'car_model_id' => 5,
            'policy_id' => 1,
            'number_seats' => 4,
            'category_rent' => 'Tidak Dengan Driver',
            'Category' => 'manual',
            'rental_price_per_day' => 300000,
            'duration' => '1 Hari',
            'status' => '1',
            'description' => 'Jangan menyakiti',
            'image_url' => null,
            'years' => '2019',
        ]);

    }
}

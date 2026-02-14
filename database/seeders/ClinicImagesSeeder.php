<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 15) as $index) {
            DB::table('clinic_images')->insert([
                'clinic_id' => $faker->numberBetween(1, 3),
                'image' => 'images/not_found.jpg',
                'main' => 0,
            ]);
        }
    }
}

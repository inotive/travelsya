<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicPackageImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 15) as $index) {
            DB::table('clinic_package_images')->insert([
                'clinic_package_id' => $faker->numberBetween(4, 9),
                'image' => 'images/not_found.jpg',
                'main' => 0,
            ]);
        }
    }
}

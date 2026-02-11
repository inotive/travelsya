<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicRatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 15) as $index) {
            DB::table('clinic_ratings')->insert([
                'transaction_id' => $faker->numberBetween(21, 40),
                'clinic_id' => $faker->numberBetween(1, 3),
                'clinic_package_id' => $faker->numberBetween(4, 9),
                'user_id' => $faker->numberBetween(1, count(User::get())),
                'rate' => $faker->numberBetween(1, 5),
                'comment' => $faker->sentence(),
            ]);
        }
    }
}

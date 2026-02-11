<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecreationRatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 20) as $index) {
            DB::table('recreation_ratings')->insert([
                'transaction_id' => $faker->numberBetween(1, 20),
                'recreation_id' => $faker->numberBetween(1, 2),
                'users_id' => $faker->numberBetween(1, count(User::get())),
                'rate' => $faker->numberBetween(1, 5),
                'comment' => $faker->sentence(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\RatingFoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RatingFoto::create([
            'id' => 1,
            'rating_id' => 1,
            'image' => 'rating-foto/1.jpg',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        RatingFoto::create([
            'id' => 2,
            'rating_id' => 1,
            'image' => 'rating-foto/2.jpg',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        RatingFoto::create([
            'id' => 3,
            'rating_id' => 2,
            'image' => 'rating-foto/3.jpg',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        RatingFoto::create([
            'id' => 4,
            'rating_id' => 3,
            'image' => 'rating-foto/4.jpg',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        RatingFoto::create([
            'id' => 5,
            'rating_id' => 4,
            'image' => 'rating-foto/5.jpg',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

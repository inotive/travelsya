<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'id' => 1,
            'transaction_id' => 1,
            'user_id' => 2,
            'hostel_id' => 2,
            'rate' => 5,
            'comment' => 'Hostelnya sangat bagus',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Rating::create([
            'id' => 2,
            'transaction_id' => 2,
            'user_id' => 3,
            'hostel_id' => 2,
            'rate' => 4,
            'comment' => 'Hostelnya bagus',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Rating::create([
            'id' => 3,
            'transaction_id' => 3,
            'user_id' => 4,
            'hostel_id' => 3,
            'rate' => 3,
            'comment' => 'Hostelnya cukup bagus',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Rating::create([
            'id' => 4,
            'transaction_id' => 4,
            'user_id' => 5,
            'hostel_id' => 4,
            'rate' => 2,
            'comment' => 'Hostelnya biasa saja',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Rating::create([
            'id' => 5,
            'transaction_id' => 5,
            'user_id' => 6,
            'hostel_id' => 5,
            'rate' => 5,
            'comment' => 'Hostelnya sangat bagus sekali',
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

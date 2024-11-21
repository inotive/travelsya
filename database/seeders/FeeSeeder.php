<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fee::create([
            'id' => 5,
            'service_id' => 1,
            'value' => 2500.00,
            'percent' => 0,
            'deleted_at' => null,
            'created_at' => '2023-06-04 19:07:01',
            'updated_at' => '2023-06-04 19:07:01',
        ]);
        Fee::create([
            'id' => 6,
            'service_id' => 2,
            'value' => 1000.00,
            'percent' => 0,
            'deleted_at' => null,
            'created_at' => '2023-06-04 19:07:06',
            'updated_at' => '2023-06-04 19:07:06',
        ]);
        Fee::create([
            'id' => 7,
            'service_id' => 3,
            'value' => 1000.00,
            'percent' => 0,
            'deleted_at' => null,
            'created_at' => '2023-06-04 19:07:11',
            'updated_at' => '2023-06-04 19:07:11',
        ]);
        Fee::create([
            'id' => 8,
            'service_id' => 6,
            'value' => 1000.00,
            'percent' => 0,
            'deleted_at' => null,
            'created_at' => '2023-06-04 19:07:17',
            'updated_at' => '2023-06-04 19:07:17',
        ]);
        Fee::create([
            'id' => 9,
            'service_id' => 7,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => '2023-06-04 19:07:25',
            'updated_at' => '2023-06-04 19:07:25',
        ]);
        Fee::create([
            'id' => 10,
            'service_id' => 4,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 11,
            'service_id' => 5,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 12,
            'service_id' => 8,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 13,
            'service_id' => 9,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 14,
            'service_id' => 10,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 15,
            'service_id' => 11,
            'value' => 1.00,
            'percent' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Fee::create([
            'id' => 16,
            'service_id' => 12,
            'value' => 2500.00,
            'percent' => 0,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

    }
}

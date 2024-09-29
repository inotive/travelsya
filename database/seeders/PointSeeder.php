<?php

namespace Database\Seeders;

use App\Models\Point;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Point::create([
            'id' => 1,
            'service_id' => 1,
            'multiple' => 10000,
            'value' => 10,
            'deleted_at' => null,
            'created_at' => '2023-06-04 11:06:25',
            'updated_at' => '2023-06-04 11:06:25',
        ]);
        Point::create([
            'id' => 2,
            'service_id' => 2,
            'multiple' => 10000,
            'value' => 10,
            'deleted_at' => null,
            'created_at' => '2023-06-04 11:06:32',
            'updated_at' => '2023-06-04 11:06:32',
        ]);
        Point::create([
            'id' => 3,
            'service_id' => 3,
            'multiple' => 10000,
            'value' => 10,
            'deleted_at' => null,
            'created_at' => '2023-06-04 11:06:39',
            'updated_at' => '2023-06-04 11:06:39',
        ]);
        Point::create([
            'id' => 4,
            'service_id' => 6,
            'multiple' => 10000,
            'value' => 10,
            'deleted_at' => null,
            'created_at' => '2023-06-04 11:06:46',
            'updated_at' => '2023-06-04 11:06:46',
        ]);
        Point::create([
            'id' => 5,
            'service_id' => 7,
            'multiple' => 1000000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => '2023-06-04 11:06:53',
            'updated_at' => '2023-06-04 11:06:53',
        ]);
        Point::create([
            'id' => 6,
            'service_id' => 4,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 7,
            'service_id' => 5,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 8,
            'service_id' => 8,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 9,
            'service_id' => 9,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 10,
            'service_id' => 10,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 11,
            'service_id' => 11,
            'multiple' => 100000,
            'value' => 100,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Point::create([
            'id' => 12,
            'service_id' => 12,
            'multiple' => 10000,
            'value' => 10,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

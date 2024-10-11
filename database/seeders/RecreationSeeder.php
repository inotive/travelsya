<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RecreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recreations')->insert([
            'id' => 1,
            'user_id' => 2,
             'category_recreation_id' => 1,
            'business_name' => 'Rekreasi Alam',
            'phone' => '08123456789',
            'city' => 'Jakarta',
            'address' => 'Jl. Raya Jakarta',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

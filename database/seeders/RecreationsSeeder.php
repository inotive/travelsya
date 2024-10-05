<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecreationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('recreations')->insert([
                'user_id' => 2,
                'category_recreation_id' => 1,
                'business_name' => 'Rekreasi Alam',
                'phone' => '08123456789',
                'city' => '3171',
                'address' => 'Jl. Raya Jakarta',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
        ]);
    }
}

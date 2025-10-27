<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecreationHasPackagesSeeder extends Seeder
{
    public function run()
    {
        DB::table('recreation_has_packages')->insert([
            [
                'recreation_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi Alam',
                'rules' => 'Paket ini hanya untuk rekreasi alam',
                'description' => 'Paket rekreasi alam yang menyenangkan',
                'duration' => '30',
                'duration_unit' => 'Menit',
                'expiry_date' => '30',
                'expiry_type' => 'Hari',
                'unit_price' => '300000',
                'price' => 100000,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recreation_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi Pantai',
                'rules' => 'Paket ini hanya untuk rekreasi pantai',
                'description' => 'Paket rekreasi pantai yang menyenangkan',
                'duration' => '2',
                'duration_unit' => 'Menit',
                'expiry_date' => '30',
                'expiry_type' => 'Hari',
                'unit_price' => '500000',
                'price' => 200000,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recreation_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi Gunung',
                'rules' => 'Paket ini hanya untuk rekreasi gunung',
                'description' => 'Paket rekreasi gunung yang menyenangkan',
                'duration' => '3',
                'duration_unit' => 'Menit',
                'expiry_date' => '30',
                'expiry_type' => 'Hari',
                'unit_price' => '500000',
                'price' => 300000,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recreation_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi Laut',
                'rules' => 'Paket ini hanya untuk rekreasi laut',
                'description' => 'Paket rekreasi laut yang menyenangkan',
                'duration' => '30',
                'duration_unit' => 'Menit',
                'expiry_date' => '30',
                'expiry_type' => 'Hari',
                'unit_price' => '300000',
                'price' => 400000,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recreation_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi Alam Plus',
                'rules' => 'Paket ini hanya untuk rekreasi alam plus',
                'description' => 'Paket rekreasi alam plus yang menyenangkan',
                'duration' => '5',
                'duration_unit' => 'Menit',
                'expiry_date' => '30',
                'expiry_type' => 'Hari',
                'unit_price' => '500000',
                'price' => 500000,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecreationHasPackagesSeeder extends Seeder
{
    public function run()
    {
        $recreations = [
            ['id' => 1, 'user_id' => 2, 'business_name' => 'Rekreasi 1', 'phone' => '081234567890', 'city' => 'Jakarta', 'address' => 'Jl. Raya Jakarta No. 1', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 2, 'business_name' => 'Rekreasi 2', 'phone' => '081234567890', 'city' => 'Jakarta', 'address' => 'Jl. Raya Jakarta No. 2', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($recreations as $recreation) {
            DB::table('recreations')->updateOrInsert($recreation);
        }

        $recreationHasPackages = [
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi 1',
                'rules' => 'Aturan 1',
                'description' => 'Deskripsi 1',
                'duration' => '30',
                'lat' => 10.123456,
                'ltd' => 10.123456,
                'expiry_date' => '2024-03-01',
                'unit_price' => 'Menit',
                'price' => 100000,
                'is_active' => true,
            ],
            [
                'recreaction_id' => 2,
                'category_recreation_id' => 2,
                'name' => 'Paket Rekreasi 2',
                'rules' => 'Aturan 2',
                'description' => 'Deskripsi 2',
                'duration' => '1',
                'lat' => 10.123456,
                'ltd' => 10.123456,
                'expiry_date' => '2024-03-01',
                'unit_price' => 'Jam',
                'price' => 200000,
                'is_active' => true,
            ],
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Rekreasi 3',
                'rules' => 'Aturan 3',
                'description' => 'Deskripsi 3',
                'duration' => '2',
                'lat' => 10.123456,
                'ltd' => 10.123456,
                'expiry_date' => '2024-03-01',
                'unit_price' => 'Jam',
                'price' => 120000,
                'is_active' => false,
            ],
            [
                'recreaction_id' => 2,
                'category_recreation_id' => 2,
                'name' => 'Paket Rekreasi 4',
                'rules' => 'Aturan 4',
                'description' => 'Deskripsi 4',
                'duration' => '90',
                'lat' => 10.123456,
                'ltd' => 10.123456,
                'expiry_date' => '2024-03-01',
                'unit_price' => 'Menit',
                'price' => 150000,
                'is_active' => true,
            ],
            [
                'recreaction_id' => 2,
                'category_recreation_id' => 3,
                'name' => 'Paket Rekreasi 5',
                'rules' => 'Aturan 5',
                'description' => 'Deskripsi 5',
                'duration' => '30',
                'lat' => 10.123456,
                'ltd' => 10.123456,
                'expiry_date' => '2024-03-01',
                'unit_price' => 'Menit',
                'price' => 120000,
                'is_active' => false,
            ],
        ];

        foreach ($recreationHasPackages as $recreationHasPackage) {
            DB::table('recreation_has_packages')->updateOrInsert($recreationHasPackage);
        }
    }
}

<?php

namespace Database\Seeders;

// use app\Models\Recreation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RecreationHasPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recreation_has_packages')->insert([
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Wisata Pantai',
                'rules' => 'Paket wisata pantai ini berlaku untuk 2 orang.',
                'description' => 'Paket wisata pantai ini berlaku untuk 2 orang.',
                'duration' => '2 hari',
                'lat' => -7.288,
                'ltd' => 112.795,
                'expiry_date' => 1,
                'expiry_type' => 'Hari',
                'unit_price' => '500000',
                'price' => 1000000,
                'is_active' => 1,
            ],
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 2,
                'name' => 'Paket Wisata Gunung',
                'rules' => 'Paket wisata gunung ini berlaku untuk 3 orang.',
                'description' => 'Paket wisata gunung ini berlaku untuk 3 orang.',
                'duration' => '3 hari',
                'lat' => -7.290,
                'ltd' => 112.800,
                'expiry_date' => 3,
                'expiry_type' => 'Hari',
                'unit_price' => '750000',
                'price' => 2250000,
                'is_active' => 0,
            ],
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 3,
                'name' => 'Paket Wisata Alam',
                'rules' => 'Paket wisata alam ini berlaku untuk 4 orang.',
                'description' => 'Paket wisata alam ini berlaku untuk 4 orang.',
                'duration' => '4 hari',
                'lat' => -7.292,
                'ltd' => 112.805,
                'expiry_date' => 2,
                'expiry_type' => 'Hari',
                'unit_price' => '1000000',
                'price' => 4000000,
                'is_active' => 0,
            ],
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 3,
                'name' => 'Paket Wisata Bawah Laut',
                'rules' => 'Paket wisata bawah laut ini berlaku untuk 5 orang.',
                'description' => 'Paket wisata bawah laut ini berlaku untuk 5 orang.',
                'duration' => '5 hari',
                'lat' => -7.294,
                'ltd' => 112.810,
                'expiry_date' => 2,
                'expiry_type' => 'Jam',
                'unit_price' => '1250000',
                'price' => 6250000,
                'is_active' => 1,
            ],
            [
                'recreaction_id' => 1,
                'category_recreation_id' => 1,
                'name' => 'Paket Wisata Pantai 2',
                'rules' => 'Paket wisata pantai ini berlaku untuk 2 orang.',
                'description' => 'Paket wisata pantai ini berlaku untuk 2 orang.',
                'duration' => '2 hari',
                'lat' => -7.286,
                'ltd' => 112.790,
                'expiry_date' => 2,
                'expiry_type' => 'Jam',
                'unit_price' => '500000',
                'price' => 1000000,
                'is_active' => 0,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HealthBeautyPackage;

class HealthBeautyPackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Paket Basic',
                'description' => 'Paket perawatan dasar untuk pemula. Termasuk facial basic dan perawatan kulit sederhana.',
                'price' => 250000,
                'validity_days' => 30,
                'is_active' => true
            ],
            [
                'name' => 'Paket Premium',
                'description' => 'Paket perawatan lengkap dengan fasilitas premium. Termasuk facial, lulur, dan pijat relaksasi.',
                'price' => 500000,
                'validity_days' => 60,
                'is_active' => true
            ],
            [
                'name' => 'Paket Gold',
                'description' => 'Paket perawatan eksklusif dengan layanan terbaik. Termasuk semua perawatan premium plus treatment khusus.',
                'price' => 1000000,
                'validity_days' => 90,
                'is_active' => true
            ],
            [
                'name' => 'Paket Keluarga',
                'description' => 'Paket khusus untuk keluarga. Dapat digunakan oleh 4 orang anggota keluarga.',
                'price' => 2000000,
                'validity_days' => 120,
                'is_active' => true
            ],
            [
                'name' => 'Paket Corporate',
                'description' => 'Paket khusus untuk perusahaan. Cocok untuk hadiah karyawan atau program kesehatan perusahaan.',
                'price' => 5000000,
                'validity_days' => 180,
                'is_active' => true
            ]
        ];

        foreach ($packages as $package) {
            HealthBeautyPackage::create($package);
        }

        $this->command->info('Berhasil menambahkan ' . count($packages) . ' paket health & beauty.');
    }
}
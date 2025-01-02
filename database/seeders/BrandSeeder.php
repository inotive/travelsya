<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Ford',
        ]);

        Brand::create([
            'name' => 'Toyota',
        ]);

        Brand::create([
            'name' => 'Hyundai',
        ]);

        Brand::create([
            'name' => 'Honda',
        ]);

        Brand::create([
            'name' => 'Mitsubishi',
        ]);
    }
}

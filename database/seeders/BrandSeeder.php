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
            'name' => 'Pajero Sports',
        ]);

        Brand::create([
            'name' => 'Honda Civic',
        ]);

        Brand::create([
            'name' => 'HRV',
        ]);

        Brand::create([
            'name' => 'Carry',
        ]);

        Brand::create([
            'name' => 'Xenia',
        ]);

        Brand::create([
            'name' => 'Sigra',
        ]);

        Brand::create([
            'name' => 'Honda Jazz',
        ]);
    }
}

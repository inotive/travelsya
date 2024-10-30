<?php

namespace Database\Seeders;

use App\Models\CategoriesServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        CategoriesServices::create([
            'name' => 'Laser',
            'type' => 'kecantikan'
        ]);

        CategoriesServices::create([
            'name' => 'Pijat',
            'type' => 'kesehatan'
        ]);

        CategoriesServices::create([
            'name' => 'Beauty',
            'type' => 'kecantikan'
        ]);

        CategoriesServices::create([
            'name' => 'Health',
            'type' => 'kesehatan'
        ]);

    }
}

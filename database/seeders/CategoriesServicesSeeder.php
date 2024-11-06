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
            'name' => 'Threadlift'
        ]);

        CategoriesServices::create([
            'name' => 'Peeling'
        ]);

        CategoriesServices::create([
            'name' => 'Injection'
        ]);

    }
}

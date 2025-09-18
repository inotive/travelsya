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
        $categories = ['Threadlift', 'Peeling', 'Injection', 'Clinic'];
        
        foreach ($categories as $category) {
            CategoriesServices::firstOrCreate([
                'name' => $category
            ]);
        }
    }
}

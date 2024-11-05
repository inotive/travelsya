<?php

namespace Database\Seeders;

use App\Models\CategoryRecreation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryRecreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryRecreation::create([
            "name" => "Atraksi"
        ]);

        CategoryRecreation::create([
            "name" => "Spa & Kecantikan"
        ]);

        CategoryRecreation::create([
            "name" => "Event"
        ]);
    }
}

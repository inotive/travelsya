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
            "name" => "Atraksi",
            "image" => "images/sanjoy-saha-C_OTD4dVchI-unsplash.jpg"
        ]);

        CategoryRecreation::create([
            "name" => "Arena",
            "image" => "images/ark-fen-5jtPZhhHc0w-unsplash.jpg"
        ]);

        CategoryRecreation::create([
            "name" => "Event",
            "image" => "images/rachel-coyne-U7HLzMO4SIY-unsplash.jpg"
        ]);
    }
}

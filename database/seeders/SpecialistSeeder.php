<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialist::create([
            'name' => 'Dokter Estetika'
        ]);

        Specialist::create([
            'name' => 'Dokter Umum'
        ]);
    }
}

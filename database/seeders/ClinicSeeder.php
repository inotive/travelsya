<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Clinic::create([
            'clinic_name' => 'Klinik Sehat Sentosa',
            'user_id' => 3,
            'is_active' => true,
            'city' => '3171',
            'phone' => '081234567890',
            'address' => 'Jl. Pahlawan No. 10, Surabaya',
            'category' => 'Kesehatan Umum',
            'open' => '08:00',
            'close' => '20:00',
            'description' => 'Klinik Sehat Sentosa melayani pemeriksaan kesehatan umum dan spesialis.',
            'highlight' => 'Pelayanan cepat dan ramah',
            'badge' => '10:00',
            'lat' => '-7.257472',
            'ltd' => '112.752090',
        ]);
    }
}

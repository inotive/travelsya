<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ClinicHasPackages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicHasPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinic = Clinic::first();
        ClinicHasPackages::create([
            'clinic_id' => $clinic->id,
            'categories_services_id' => '1',
            'specialist_id' => '1',
            'name' => 'Jasa Potong Rambut',
            'rules' => 'peraturan 123',
            'description' => 'barbershop tommy di regency',
            'duration' => '30',
            'expiry_date' => '30',
            'unit_price' => '750000',
            'price' => '250000',

        ]);

        ClinicHasPackages::create([
            'clinic_id' => $clinic->id,
            'categories_services_id' => '3',
            'specialist_id' => '1',
            'name' => 'Jasa Manikur',
            'rules' => '123 peraturan',
            'description' => 'klinik kecantikan manikur di balikpapan',
            'duration' => '40',
            'expiry_date' => '14',
            'unit_price' => '750000',
            'price' => '550000',

        ]);

        ClinicHasPackages::create([
            'clinic_id' => $clinic->id,
            'categories_services_id' => '2',
            'specialist_id' => '1',
            'name' => 'Jasa Potong Rambut',
            'rules' => 'peraturan 123',
            'description' => 'Salon kecantikan rara',
            'duration' => '40',
            'expiry_date' => '2',
            'unit_price' => '750000',
            'price' => '300000',
        ]);

        ClinicHasPackages::create([
            'clinic_id' => $clinic->id,
            'categories_services_id' => '2',
            'specialist_id' => '1',
            'name' => 'Klinik manikur',
            'rules' => 'peraturan 123',
            'description' => 'klinik manikur asal jepang hadir di balikpapan',
            'duration' => '60',
            'expiry_date' => '10',
            'unit_price' => '750000',
            'price' => '400000',
        ]);

        ClinicHasPackages::create([
            'clinic_id' => $clinic->id,
            'categories_services_id' => '3',
            'specialist_id' => '1',
            'name' => 'Jasa Potong Rambut',
            'rules' => 'peraturan 123',
            'description' => 'Barbershop Billy ',
            'duration' => '30',
            'expiry_date' => '12',
            'unit_price' => '750000',
            'price' => '350000',
        ]);
    }
}

<?php

namespace Database\Seeders;


use App\Models\ClinicHasPackages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicHasPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClinicHasPackages::create([
            'clinic_id'=>1,
            'categories_services_id'=>'1',
            'specialist_id'=>'1',
            'name'=>'klinik dr.steven',
            'rules'=>'peraturan',
            'description'=>'klinik kecantikan yang menawarkan perawatan kulit wajah',
            'duration'=>'90 menit',
            'expiry_date'=>'2024-9-10',
            'unit_price'=>'Rp',
            'price'=>'500.000',
           
        ]);
    }
}

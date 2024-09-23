<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\CarRental;
use Illuminate\Database\Seeder;
use App\Models\CarRentalHasCars;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarRentalHasCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat data car_rentals terlebih dahulu
         $carRental = CarRental::create([
            'business_name' => 'Mitra 1',
            'user_id' => 1,
            'is_active' => true,
            'city' => 'Surabaya',
            'phone' => '089980776155',
            'address' => 'alamat',
        ]);

        $policyId = DB::table('policies')->insertGetId([
            'car_rental_id' => $carRental->id,
            'name' => 'Policy 1',
            'description' => 'Deskripsi Policy 1',
        ]);

        $data = [
            [
                'car_rental_id' => $carRental->id,
                'brand_id' => Brand::where('id', 1)->first()->id,
                'car_model_id' => CarModel::where('id', 1)->first()->id,
                'policy_id' =>  $policyId,
                'number_seats' => 4,
                'category_rent' => 'Dengan Driver',
                'category' => 'automatic',
                'rental_price_per_day' => 500000,
                'status' => 'Tidak Aktif',
                'description' => 'Mobil sedan dengan 4 kursi',
                'image_url' => 'gambar',
            ],
        ];

        foreach ($data as $item) {
            CarRentalHasCars::create($item);
        }
    }
}

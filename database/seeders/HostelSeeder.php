<?php

namespace Database\Seeders;

use App\Models\Hostel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hostel::create([
            'id' => 2,
            'user_id' => 2,
            'name' => 'Hostel Balikpapan',
            'description' => '-',
            'city' => 'Balikpapan',
            'kecamatan' => '-',
            'address' => 'Jl.ulin Raya Rt 11 No 55',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'phone' => null,
            'email' => null,
            'website' => 'Belum ada',
            'star' => 4,
            'property' => '-',
            'is_active' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Hostel::create([
            'id' => 3,
            'user_id' => 2,
            'name' => 'Hostel 1',
            'description' => '-',
            'city' => 'Balikpapan',
            'kecamatan' => '-',
            'address' => 'Jl. MT Haryono Rt 35, No.31',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'phone' => null,
            'email' => null,
            'website' => '-',
            'star' => 3,
            'property' => '-',
            'is_active' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Hostel::create([
            'id' => 4,
            'user_id' => 2,
            'name' => 'Hostel 2',
            'description' => '-',
            'city' => 'Samarinda',
            'kecamatan' => '-',
            'address' => 'Jl. Sungai Ampal Rt.34 No.13 Kel. Sumpang',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'phone' => null,
            'email' => null,
            'website' => '-',
            'star' => 3,
            'property' => '-',
            'is_active' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Hostel::create([
            'id' => 5,
            'user_id' => 2,
            'name' => 'Hostel 3',
            'description' => '-',
            'city' => 'Samarinda',
            'kecamatan' => '-',
            'address' => 'Jl. Pahlawan No. 12 Rt. 14, Samarinda',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'phone' => null,
            'email' => null,
            'website' => '-',
            'star' => 3,
            'property' => '-',
            'is_active' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        Hostel::create([
            'id' => 6,
            'user_id' => 2,
            'name' => 'Hostel 4',
            'description' => '-',
            'city' => 'Tenggarong',
            'kecamatan' => '-',
            'address' => 'Jl. Pahlawan No. 12 Rt. 14, Tenggarong',
            'facilities' => '-',
            'lat' => '-',
            'lon' => '-',
            'category' => 'Harian',
            'checkin' => '11:00',
            'checkout' => '12:00',
            'phone' => null,
            'email' => null,
            'website' => '-',
            'star' => 3,
            'property' => '-',
            'is_active' => 1,
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

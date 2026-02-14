<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create([
            'id' => 2,
            'user_id' => 8,
            'name' => 'hemra hotel',
            'description' => NULL,
            'city' => 'Balikpapan',
            'kecamatan' => NULL,
            'address' => 'Jl. MT Haryono No.5, RW No.85, Damai, Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76114 0542-762290',
            'facilities' => NULL,
            'lat' => NULL,
            'lon' => NULL,
            'checkin' => '11:00:00',
            'checkout' => '12:00:00',
            'phone' => NULL,
            'email' => NULL,
            'website' => 'www',
            'star' => 3,
            'is_active' => 1,
            'deleted_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        Hotel::create([
            'id' => 3,
            'user_id' => 2,
            'name' => 'Hotel Baru Balikpapan',
            'description' => '-',
            'city' => 'Balikpapan',
            'kecamatan' => NULL,
            'address' => 'Jl. Syarifuddin Yoes No.88, Sepinggan, Kecamatan Balikpapan Selatan, Kota',
            'facilities' => NULL,
            'lat' => NULL,
            'lon' => NULL,
            'checkin' => '11:00:00',
            'checkout' => '12:00:00',
            'phone' => '085820818272',
            'email' => 'mitra@gmail.com',
            'website' => '-',
            'star' => 2,
            'is_active' => 1,
            'deleted_at' => NULL,
            'created_at' => '2023-10-22 03:54:46',
            'updated_at' => NULL,
        ]);
        Hotel::create([
            'id' => 4,
            'user_id' => 2,
            'name' => 'Hemra Hotel',
            'description' => NULL,
            'city' => 'Balikpapan',
            'kecamatan' => NULL,
            'address' => 'Jl. MT Haryono No.5, RW No.85, Damai, Balikpapan Kota, Kota Balikpapan,',
            'facilities' => NULL,
            'lat' => NULL,
            'lon' => NULL,
            'checkin' => '11:00:00',
            'checkout' => '12:00:00',
            'phone' => NULL,
            'email' => NULL,
            'website' => '-',
            'star' => 3,
            'is_active' => 1,
            'deleted_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        Hotel::create([
            'id' => 6,
            'user_id' => 15,
            'name' => 'hotel ayu',
            'description' => NULL,
            'city' => 'Balikpapan',
            'kecamatan' => NULL,
            'address' => 'Jl. P antasari, No.18 Rt.001 karang rejo Balikpapan Tengah, Kalimantan Timur. telp.0542-425290',
            'facilities' => NULL,
            'lat' => NULL,
            'lon' => NULL,
            'checkin' => '11:00:00',
            'checkout' => '12:00:00',
            'phone' => NULL,
            'email' => NULL,
            'website' => '--',
            'star' => 1,
            'is_active' => 1,
            'deleted_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        Hotel::create([
            'id' => 7,
            'user_id' => 2,
            'name' => 'Hotel Testing',
            'description' => NULL,
            'city' => 'Balikpapan',
            'kecamatan' => NULL,
            'address' => 'Jl. P antasari, No.18 Rt.001 karang rejo Balikpapan Tengah, Kalimantan Timur. telp.0542-425290',
            'facilities' => NULL,
            'lat' => NULL,
            'lon' => NULL,
            'checkin' => '11:00:00',
            'checkout' => '12:00:00',
            'phone' => NULL,
            'email' => NULL,
            'website' => '--',
            'star' => 1,
            'is_active' => 1,
            'deleted_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }
}

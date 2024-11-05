<?php

namespace Database\Seeders;

use App\Models\HotelImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelImage::create([
            'id' => 3,
            'hotel_id' => 2,
            'image' => 'media/hotel/jm3IY8hyYiPxlSCWlDP7Mzde8eVSh3Trq5EidaKY.jpg',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-11 17:56:47',
            'updated_at' => '2023-10-11 17:56:47',
        ]);
        HotelImage::create([
            'id' => 4,
            'hotel_id' => 2,
            'image' => 'media/hotel/9tMsPICeCKTdCgFQojPluQ72KT6LJg6QmKI0J3h6.jpg',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-11 17:56:54',
            'updated_at' => '2023-10-11 17:56:54',
        ]);
        HotelImage::create([
            'id' => 5,
            'hotel_id' => 2,
            'image' => 'media/hotel/9tXsKl2wMdnqEoDs9ZmdoR6o5nu43fiPeQkQttPE.jpg',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-11 19:40:28',
            'updated_at' => '2023-10-11 19:40:35',
        ]);
        HotelImage::create([
            'id' => 6,
            'hotel_id' => 3,
            'image' => 'media/hotel/HF12RWT921DBL09z3GsqK32GtJ5FAhm63rw0SJuz.jpg',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:25:40',
            'updated_at' => '2023-10-12 18:25:48',
        ]);
        HotelImage::create([
            'id' => 7,
            'hotel_id' => 4,
            'image' => 'media/hotel/AomDUp0Tbp3m6nLzvPntvQsIk5f8oRU5tJlTevre.jpg',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:26:07',
            'updated_at' => '2023-10-12 18:26:09',
        ]);
        HotelImage::create([
            'id' => 8,
            'hotel_id' => 6,
            'image' => 'media/hotel/rjkApd44h8ki16sDLLROs7nAU4VXZOYxrSGepL5t.webp',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-17 19:10:04',
            'updated_at' => '2023-10-17 21:03:35',
        ]);
        HotelImage::create([
            'id' => 9,
            'hotel_id' => 6,
            'image' => 'media/hotel/ipXnUOHNq4ehvmrPq9SeJHCPOECUw4bgL36SOeap.webp',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-17 21:03:17',
            'updated_at' => '2023-10-17 21:03:35',
        ]);
        HotelImage::create([
            'id' => 10,
            'hotel_id' => 6,
            'image' => 'media/hotel/IVB6J0uxF9N7mR97FJ5ztvgjU2fs3nnH6fiz07I6.jpg',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-17 21:03:32',
            'updated_at' => '2023-10-17 21:03:35',
        ]);
    }
}

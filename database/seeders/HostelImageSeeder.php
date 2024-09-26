<?php

namespace Database\Seeders;

use App\Models\HostelImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelImage::create([
            'id' => 1,
            'hostel_id' => 2,
            'image' => 'zqJmnlIsf42Ga8EghgpQfZOokJxmX1EWc76GbAlU.webp',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-11 07:28:21',
            'updated_at' => '2023-10-11 07:28:23',
        ]);
        HostelImage::create([
            'id' => 2,
            'hostel_id' => 3,
            'image' => 'OhoSyqY5gtK4F9ewIFNanVmzrj34Who8es4DoIfd.jpg',
            'main' => 1,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:35:49',
            'updated_at' => '2023-10-12 18:35:58',
        ]);
        HostelImage::create([
            'id' => 3,
            'hostel_id' => 4,
            'image' => 'bQj7m8s9r9JUa5LwL4XKzQZCn8k7hL9Uo6n7IzJn.jpg',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:36:04',
            'updated_at' => '2023-10-12 18:36:06',
        ]);
        HostelImage::create([
            'id' => 4,
            'hostel_id' => 5,
            'image' => '1O4xgGZ4tj9M9A3cE9S7D3h5R7H3F1G2w3V4B4.webp',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:36:13',
            'updated_at' => '2023-10-12 18:36:16',
        ]);
        HostelImage::create([
            'id' => 5,
            'hostel_id' => 6,
            'image' => 'Hs8F3R4tj9S6D3cE9S7Q3h5R7H3F1G2w3V4B4.jpg',
            'main' => 0,
            'deleted_at' => null,
            'created_at' => '2023-10-12 18:36:21',
            'updated_at' => '2023-10-12 18:36:24',
        ]);
    }
}

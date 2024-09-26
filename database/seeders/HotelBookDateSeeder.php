<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelBookDate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelBookDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelBookDate::create([
            'id' => 1,
            'transaction_id' => 1,
            'hotel_room_id' => 10, //10 - 21
            'hotel_id' => 2, //2 - 7
            'start' => '2023-01-01',
            'end' => '2023-01-31',
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelBookDate::create([
            'id' => 2,
            'transaction_id' => 2,
            'hotel_room_id' => 11,
            'hotel_id' => 3,
            'start' => '2023-01-01',
            'end' => '2023-01-31',
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelBookDate::create([
            'id' => 3,
            'transaction_id' => 3,
            'hotel_room_id' => 12,
            'hotel_id' => 4,
            'start' => '2023-01-01',
            'end' => '2023-01-31',
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelBookDate::create([
            'id' => 4,
            'transaction_id' => 4,
            'hotel_room_id' => 13,
            'hotel_id' => 4,
            'start' => '2023-01-01',
            'end' => '2023-01-31',
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelBookDate::create([
            'id' => 5,
            'transaction_id' => 5,
            'hotel_room_id' => 14,
            'hotel_id' => 6,
            'start' => '2023-01-01',
            'end' => '2023-01-31',
            'deleted_at' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

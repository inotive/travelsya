<?php

namespace Database\Seeders;

use App\Models\HotelRoomFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRoomFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelRoomFacility::create([
            'hotel_id' => 3,
            'hotel_room_id' => 12,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 4,
            'hotel_room_id' => 15,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 6,
            'hotel_room_id' => 16,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 6,
            'hotel_room_id' => 17,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 6,
            'hotel_room_id' => 18,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 19,
            'facility_id' => 11,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 19,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 20,
            'facility_id' => 11,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 20,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 21,
            'facility_id' => 11,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 21,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 22,
            'facility_id' => 11,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 2,
            'hotel_room_id' => 22,
            'facility_id' => 12,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 7,
            'hotel_room_id' => 23,
            'facility_id' => 15,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 7,
            'hotel_room_id' => 23,
            'facility_id' => 16,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 7,
            'hotel_room_id' => 23,
            'facility_id' => 17,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HotelRoomFacility::create([
            'hotel_id' => 7,
            'hotel_room_id' => 23,
            'facility_id' => 18,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

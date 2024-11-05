<?php

namespace Database\Seeders;

use App\Models\Hostel;
use App\Models\HostelRoomFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelRoomFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 8,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 1,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 2,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 3,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 4,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 5,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 6,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomFacility::create([
            'hostel_id' => 2,
            'hostel_room_id' => 7,
            'facility_id' => 10,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

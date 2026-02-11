<?php

namespace Database\Seeders;

use App\Models\HotelRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelRating::create([
            'id' => 1,
            'hotel_id' => 4,
            'hotel_room_id' => 13,
            'users_id' => 3,
            'rate' => 5,
            'comment' => 'Hotelnya bagus sekali',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'transaction_id' => 2,
        ]);
        HotelRating::create([
            'id' => 2,
            'hotel_id' => 4,
            'hotel_room_id' => 14,
            'users_id' => 4,
            'rate' => 3,
            'comment' => 'Hotelnya cukup bagus',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'transaction_id' => 3,
        ]);

        HotelRating::create([
            'id' => 3,
            'hotel_id' => 6,
            'hotel_room_id' => 15,
            'users_id' => 5,
            'rate' => 4,
            'comment' => 'Hotelnya lumayan',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'transaction_id' => 4,
        ]);

        HotelRating::create([
            'id' => 4,
            'hotel_id' => 7,
            'hotel_room_id' => 16,
            'users_id' => 6,
            'rate' => 2,
            'comment' => 'Hotelnya biasa saja',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'transaction_id' => 5,
        ]);

        HotelRating::create([
            'id' => 5,
            'hotel_id' => 7,
            'hotel_room_id' => 17,
            'users_id' => 7,
            'rate' => 1,
            'comment' => 'Hotelnya tidak bagus',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'transaction_id' => 6,
        ]);
    }
}

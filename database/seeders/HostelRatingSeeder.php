<?php

namespace Database\Seeders;

use App\Models\HostelRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelRating::create([
            'id' => 1,
            'hostel_id' => 2,
            'hostel_room_id' => 1,
            'users_id' => 1,
            'rate' => 5,
            'comment' => 'Kamar hostelnya bersih dan nyaman. Pelayanannya ramah dan sigap. Saya akan kembali lagi',
            'transaction_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRating::create([
            'id' => 2,
            'hostel_id' => 2,
            'hostel_room_id' => 2,
            'users_id' => 2,
            'rate' => 4,
            'comment' => 'Kamar hostelnya lumayan. Pelayanannya biasa saja. Mungkin saya akan kembali lagi',
            'transaction_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRating::create([
            'id' => 3,
            'hostel_id' => 3,
            'hostel_room_id' => 3,
            'users_id' => 3,
            'rate' => 3,
            'comment' => 'Kamar hostelnya kurang bersih. Pelayanannya ramah tapi agak lambat. Mungkin saya tidak akan kembali lagi',
            'transaction_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRating::create([
            'id' => 4,
            'hostel_id' => 4,
            'hostel_room_id' => 4,
            'users_id' => 4,
            'rate' => 2,
            'comment' => 'Kamar hostelnya agak sempit. Pelayanannya tidak ramah. Saya tidak akan kembali lagi',
            'transaction_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRating::create([
            'id' => 5,
            'hostel_id' => 4,
            'hostel_room_id' => 5,
            'users_id' => 5,
            'rate' => 1,
            'comment' => 'Kamar hostelnya sangat kecil. Pelayanannya tidak ramah sama sekali. Saya tidak akan kembali lagi',
            'transaction_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

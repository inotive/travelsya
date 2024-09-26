<?php

namespace Database\Seeders;

use App\Models\BookDate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookDate::create([
            'transaction_id' => 1,
            'hostel_room_id' => 1,
            'start' => now(),
            'end' => now()->addDays(5),
        ]);
        BookDate::create([
            'transaction_id' => 1,
            'hostel_room_id' => 2,
            'start' => now()->addDays(5),
            'end' => now()->addDays(10),
        ]);
        BookDate::create([
            'transaction_id' => 2,
            'hostel_room_id' => 3,
            'start' => now()->addDays(10),
            'end' => now()->addDays(15),
        ]);
        BookDate::create([
            'transaction_id' => 3,
            'hostel_room_id' => 4,
            'start' => now()->addDays(15),
            'end' => now()->addDays(20),
        ]);
        BookDate::create([
            'transaction_id' => 4,
            'hostel_room_id' => 5,
            'start' => now()->addDays(20),
            'end' => now()->addDays(25),
        ]);
    }
}

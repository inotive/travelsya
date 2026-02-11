<?php

namespace Database\Seeders;

use App\Models\DetailTransactionHostel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransactionHostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailTransactionHostel::create([
            'id' => 1,
            'transaction_id' => 52,
            'hostel_id' => 3,
            'hostel_room_id' => 8,
            'type_rent' => 'bulanan',
            'booking_id' => 'adas',
            'reservation_start' => '2023-10-24',
            'reservation_end' => '2023-10-24',
            'guest' => 2,
            'room' => 3,
            'rent_price' => 1000000,
            'fee_admin' => 15000,
            'kode_unik' => '120',
            'created_at' => '2023-11-15 14:56:19',
            'updated_at' => '2023-11-18 14:56:20',
            'guest_name' => 'Joko',
            'guest_email' => 'joko@gmail.com',
            'guest_handphone' => '08123456789',
        ]);

        DetailTransactionHostel::create([
            'id' => 2,
            'transaction_id' => 53,
            'hostel_id' => 4,
            'hostel_room_id' => 8,
            'type_rent' => 'bulanan',
            'booking_id' => 'adas2',
            'reservation_start' => '2023-10-25',
            'reservation_end' => '2023-10-25',
            'guest' => 2,
            'room' => 3,
            'rent_price' => 1000000,
            'fee_admin' => 15000,
            'kode_unik' => '120',
            'created_at' => '2023-11-15 14:56:19',
            'updated_at' => '2023-11-18 14:56:20',
            'guest_name' => 'Joko2',
            'guest_email' => 'joko2@gmail.com',
            'guest_handphone' => '08123456789',
        ]);

        DetailTransactionHostel::create([
            'id' => 3,
            'transaction_id' => 54,
            'hostel_id' => 5,
            'hostel_room_id' => 8,
            'type_rent' => 'bulanan',
            'booking_id' => 'adas3',
            'reservation_start' => '2023-10-26',
            'reservation_end' => '2023-10-26',
            'guest' => 2,
            'room' => 3,
            'rent_price' => 1000000,
            'fee_admin' => 15000,
            'kode_unik' => '120',
            'created_at' => '2023-11-15 14:56:19',
            'updated_at' => '2023-11-18 14:56:20',
            'guest_name' => 'Joko3',
            'guest_email' => 'joko3@gmail.com',
            'guest_handphone' => '08123456789',
        ]);

        DetailTransactionHostel::create([
            'id' => 4,
            'transaction_id' => 55,
            'hostel_id' => 2,
            'hostel_room_id' => 8,
            'type_rent' => 'bulanan',
            'booking_id' => 'adas4',
            'reservation_start' => '2023-10-27',
            'reservation_end' => '2023-10-27',
            'guest' => 2,
            'room' => 3,
            'rent_price' => 1000000,
            'fee_admin' => 15000,
            'kode_unik' => '120',
            'created_at' => '2023-11-15 14:56:19',
            'updated_at' => '2023-11-18 14:56:20',
            'guest_name' => 'Joko4',
            'guest_email' => 'joko4@gmail.com',
            'guest_handphone' => '08123456789',
        ]);

        DetailTransactionHostel::create([
            'id' => 5,
            'transaction_id' => 56,
            'hostel_id' => 6,
            'hostel_room_id' => 8,
            'type_rent' => 'bulanan',
            'booking_id' => 'adas5',
            'reservation_start' => '2023-10-28',
            'reservation_end' => '2023-10-28',
            'guest' => 2,
            'room' => 3,
            'rent_price' => 1000000,
            'fee_admin' => 15000,
            'kode_unik' => '120',
            'created_at' => '2023-11-15 14:56:19',
            'updated_at' => '2023-11-18 14:56:20',
            'guest_name' => 'Joko5',
            'guest_email' => 'joko5@gmail.com',
            'guest_handphone' => '08123456789',
        ]);

    }
}

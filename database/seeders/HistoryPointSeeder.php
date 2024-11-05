<?php

namespace Database\Seeders;

use App\Models\HistoryPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoryPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryPoint::create([
            'id' => 1,
            'user_id' => 3,
            'transaction_id' => 64,
            'flow' => 'debit',
            'point' => 138,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 06:20:29',
            'updated_at' => '2023-10-19 06:20:29',
        ]);
        HistoryPoint::create([
            'id' => 2,
            'user_id' => 3,
            'transaction_id' => 66,
            'flow' => 'debit',
            'point' => 21,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 06:30:13',
            'updated_at' => '2023-10-19 06:30:13',
        ]);
        HistoryPoint::create([
            'id' => 3,
            'user_id' => 3,
            'transaction_id' => 69,
            'flow' => 'debit',
            'point' => 23,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 07:14:36',
            'updated_at' => '2023-10-19 07:14:36',
        ]);
        HistoryPoint::create([
            'id' => 4,
            'user_id' => 3,
            'transaction_id' => 70,
            'flow' => 'debit',
            'point' => 23,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 07:17:24',
            'updated_at' => '2023-10-19 07:17:24',
        ]);
        HistoryPoint::create([
            'id' => 5,
            'user_id' => 3,
            'transaction_id' => 55,
            'flow' => 'debit',
            'point' => 751,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 08:51:52',
            'updated_at' => '2023-10-19 08:51:52',
        ]);
        HistoryPoint::create([
            'id' => 6,
            'user_id' => 3,
            'transaction_id' => 60,
            'flow' => 'debit',
            'point' => 173,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 11:10:51',
            'updated_at' => '2023-10-19 11:10:51',
        ]);
        HistoryPoint::create([
            'id' => 7,
            'user_id' => 10,
            'transaction_id' => 61,
            'flow' => 'debit',
            'point' => 13,
            'date' => '2023-10-19',
            'deleted_at' => null,
            'created_at' => '2023-10-19 12:00:51',
            'updated_at' => '2023-10-19 12:00:51',
        ]);
        HistoryPoint::create([
            'id' => 8,
            'user_id' => 6,
            'transaction_id' => 71,
            'flow' => 'debit',
            'point' => 261,
            'date' => '2023-10-20',
            'deleted_at' => null,
            'created_at' => '2023-10-19 16:10:01',
            'updated_at' => '2023-10-19 16:10:01',
        ]);
        HistoryPoint::create([
            'id' => 9,
            'user_id' => 3,
            'transaction_id' => 53,
            'flow' => 'debit',
            'point' => 259,
            'date' => '2023-10-20',
            'deleted_at' => null,
            'created_at' => '2023-10-19 16:10:50',
            'updated_at' => '2023-10-19 16:10:50',
        ]);
        HistoryPoint::create([
            'id' => 10,
            'user_id' => 3,
            'transaction_id' => 74,
            'flow' => 'debit',
            'point' => 136,
            'date' => '2023-10-20',
            'deleted_at' => null,
            'created_at' => '2023-10-20 04:59:13',
            'updated_at' => '2023-10-20 04:59:13',
        ]);
        HistoryPoint::create([
            'id' => 11,
            'user_id' => 3,
            'transaction_id' => 77,
            'flow' => 'debit',
            'point' => 23,
            'date' => '2023-10-22',
            'deleted_at' => null,
            'created_at' => '2023-10-22 06:47:29',
            'updated_at' => '2023-10-22 06:47:29',
        ]);
        HistoryPoint::create([
            'id' => 12,
            'user_id' => 6,
            'transaction_id' => 79,
            'flow' => 'debit',
            'point' => 27,
            'date' => '2023-10-24',
            'deleted_at' => null,
            'created_at' => '2023-10-23 18:34:24',
            'updated_at' => '2023-10-23 18:34:24',
        ]);
        HistoryPoint::create([
            'id' => 13,
            'user_id' => 3,
            'transaction_id' => 80,
            'flow' => 'debit',
            'point' => 27,
            'date' => '2023-10-24',
            'deleted_at' => null,
            'created_at' => '2023-10-23 19:55:49',
            'updated_at' => '2023-10-23 19:55:49',
        ]);
        HistoryPoint::create([
            'id' => 14,
            'user_id' => 20,
            'transaction_id' => 82,
            'flow' => 'debit',
            'point' => 462,
            'date' => '2023-10-24',
            'deleted_at' => null,
            'created_at' => '2023-10-23 21:38:47',
            'updated_at' => '2023-10-23 21:38:47',
        ]);
        HistoryPoint::create([
            'id' => 15,
            'user_id' => 20,
            'transaction_id' => 83,
            'flow' => 'debit',
            'point' => 22,
            'date' => '2023-10-24',
            'deleted_at' => null,
            'created_at' => '2023-10-23 21:51:18',
            'updated_at' => '2023-10-23 21:51:18',
        ]);
        HistoryPoint::create([
            'id' => 16,
            'user_id' => 3,
            'transaction_id' => 84,
            'flow' => 'debit',
            'point' => 23,
            'date' => '2023-10-24',
            'deleted_at' => null,
            'created_at' => '2023-10-24 05:11:41',
            'updated_at' => '2023-10-24 05:11:41',
        ]);
    }
}

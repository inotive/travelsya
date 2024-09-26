<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guest::create([
            'transaction_id' => 1,
            'name' => 'Budi',
            'identity' => '1234567890',
            'type_id' => 'KTP',
        ]);
        Guest::create([
            'transaction_id' => 2,
            'name' => 'Siti',
            'identity' => '1234567891',
            'type_id' => 'KTP',
        ]);
        Guest::create([
            'transaction_id' => 3,
            'name' => 'Tia',
            'identity' => '1234567892',
            'type_id' => 'KTP',
        ]);
        Guest::create([
            'transaction_id' => 4,
            'name' => 'Dodi',
            'identity' => '1234567893',
            'type_id' => 'KTP',
        ]);
        Guest::create([
            'transaction_id' => 5,
            'name' => 'Sri',
            'identity' => '1234567894',
            'type_id' => 'KTP',
        ]);
    }
}

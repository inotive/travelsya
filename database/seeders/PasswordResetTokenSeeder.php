<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'dummy1@gmail.com',
                'token' => '1234567890',
                'created_at' => now()
            ],
            [
                'email' => 'dummy2@gmail.com',
                'token' => '1234567891',
                'created_at' => now()
            ],
            [
                'email' => 'dummy3@gmail.com',
                'token' => '1234567892',
                'created_at' => now()
            ],
            [
                'email' => 'dummy4@gmail.com',
                'token' => '1234567893',
                'created_at' => now()
            ],
            [
                'email' => 'dummy5@gmail.com',
                'token' => '1234567894',
                'created_at' => now()
            ],
        ]);

    }
}

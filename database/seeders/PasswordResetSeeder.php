<?php

namespace Database\Seeders;

use App\Models\PasswordReset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;

class PasswordResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PasswordReset::create([
            'email' => 'contoh1@gmail.com',
            'token' => 1,
            'created_at' => now(),
        ]);

        PasswordReset::create([
            'email' => 'contoh2@gmail.com',
            'token' => 2,
            'created_at' => now(),
        ]);

        PasswordReset::create([
            'email' => 'contoh3@gmail.com',
            'token' => 3,
            'created_at' => now(),
        ]);

        PasswordReset::create([
            'email' => 'contoh4@gmail.com',
            'token' => 4,
            'created_at' => now(),
        ]);

        PasswordReset::create([
            'email' => 'contoh5@gmail.com',
            'token' => 5,
            'created_at' => now(),
        ]);

    }
}

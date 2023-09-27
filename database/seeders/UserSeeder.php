<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'phone' => '0811111111111',
            'point' => 0,
            'role' => '0',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Mitra',
            'email' => 'mitra@gmail.com',
            'email_verified_at' => Carbon::now(),
            'phone' => '0811111111110',
            'point' => 0,
            'role' => 1,
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'User Pengguna',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'phone' => '0811111111110',
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

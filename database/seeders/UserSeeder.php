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
            'remember_token' => null,
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
            'remember_token' => null,
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
            'remember_token' => null,
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin4@travelsya.test',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 0,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@travelsya.test',
            'email_verified_at' => null,
            'phone' => '085812345',
            'point' => 0,
            'role' => 0,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@travelsya.test',
            'email_verified_at' => null,
            'phone' => '08888312312',
            'point' => 0,
            'role' => 1,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Gusti Bagus Wahyu Saputra',
            'email' => 'gustibagus34@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'agil',
            'email' => 'agil@gmail.com',
            'email_verified_at' => null,
            'phone' => '08696969969',
            'point' => 1000,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Gusti Bagus',
            'email' => 'gusbagusws@gmail.com',
            'email_verified_at' => null,
            'phone' => '083838383838',
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Saputra',
            'email' => 'saputraadam035@gmail.com',
            'email_verified_at' => null,
            'phone' => '086666666666',
            'point' => 264,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'arief septian',
            'email' => 'arief.septian66@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'gusti bagus',
            'email' => 'gustibagus13@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'admin inotive',
            'email' => 'qwe@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 0,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'james',
            'email' => 'jams123@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'ado',
            'email' => 'ado123@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 7491,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Agung',
            'email' => 'agung@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'travelsyaofficial',
            'email' => 'travelsya@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 18190,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'travelsyaadmin',
            'email' => 'travelsyaadmin@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'Agung',
            'email' => 'vendor@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'travelsyaofficial',
            'email' => 'travelsyaofficial@gmail.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([
            'name' => 'trvadmin',
            'email' => 'trvadmin@admin.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::create([

            'name' => 'cstravelsya',
            'email' => 'cs@travelsya.com',
            'email_verified_at' => null,
            'phone' => null,
            'point' => 0,
            'role' => 2,
            'password' => bcrypt('password'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

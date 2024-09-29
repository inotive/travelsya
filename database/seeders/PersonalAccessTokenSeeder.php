<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_access_tokens')->insert([
            [
                'id' => 4,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => 'a614ba6ab06be0f11f6b84f272fb179f094d5b7fb17a289c3e0c4eda5e479439',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-17 05:55:09',
                'created_at' => '2023-10-13 05:44:26',
                'updated_at' => '2023-10-17 05:55:09',
            ],
            [
                'id' => 9,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 12,
                'name' => 'auth_token',
                'token' => '8dc47bb13797749752bc08a3d63fcb03fa27144d8c4b2909abb140c3ef50ee99',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-16 17:25:01',
                'created_at' => '2023-10-16 17:21:43',
                'updated_at' => '2023-10-16 17:25:01',
            ],
            [
                'id' => 19,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => '0e19b810ca1b45545b743b901943ab04285a54410c6f0bd481131146b655f486',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-24 05:11:45',
                'created_at' => '2023-10-17 08:30:46',
                'updated_at' => '2023-10-24 05:11:45',
            ],
            [
                'id' => 23,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => '657c7e0a58a006eb8d204b0f23c009eee4d00a6825512b0b954a21705434c60d',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-18 23:24:56',
                'created_at' => '2023-10-18 22:29:26',
                'updated_at' => '2023-10-18 23:24:56',
            ],
            [
                'id' => 24,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => '0e4919181d319bce0ab01c7599ea40c8dcbbc3910b442a218778d7cd1d63e48d',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-19 04:51:16',
                'created_at' => '2023-10-19 04:51:10',
                'updated_at' => '2023-10-19 04:51:16',
            ],
            [
                'id' => 25,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 1,
                'name' => 'auth_token',
                'token' => 'fabff305bf6c13f1d57d6b62c39076175ae5ef2978624d39d4ae81adc7efb2d4',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-21 19:04:36',
                'created_at' => '2023-10-19 07:06:35',
                'updated_at' => '2023-10-21 19:04:36',
            ],
            [
                'id' => 27,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 13,
                'name' => 'auth_token',
                'token' => '1653ee0fccdad488335778d6de517a163dc4d0d9a8baf777f3f712cf7dc0d63b',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-23 19:54:21',
                'created_at' => '2023-10-20 02:51:26',
                'updated_at' => '2023-10-23 19:54:21',
            ],
            [
                'id' => 28,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => '1c44abcb2567fbe713e37f345e70ddc2151f33b2cb144d96179d426195685657',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-12-19 07:53:03',
                'created_at' => '2023-10-21 19:04:57',
                'updated_at' => '2023-12-19 07:53:03',
            ],
            [
                'id' => 29,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 3,
                'name' => 'auth_token',
                'token' => '0047adba69fd202e7efcab3017b5ef940e6b4d5396444cc147ed1a45b547ddc2',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-23 05:27:27',
                'created_at' => '2023-10-22 06:36:58',
                'updated_at' => '2023-10-23 05:27:27',
            ],
            [
                'id' => 31,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 20,
                'name' => 'auth_token',
                'token' => 'f13e5c71cc7edeb5e9055f21ef96006a14a311273105f2d807b70e3c6611557e',
                'abilities' => '["*"]',
                'expires_at' => null,
                'last_used_at' => '2023-10-23 22:32:47',
                'created_at' => '2023-10-23 22:22:29',
                'updated_at' => '2023-10-23 22:32:47',
            ],

        ]);
    }
}

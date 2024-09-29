<?php

namespace Database\Seeders;

use App\Models\HostelRoomImage;
use App\Models\HostelRoomImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelRoomImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelRoomImages::create([
            'id' => 1,
            'hostel_id' => 2,
            'hostel_room_id' => 1,
            'image' => 'media/hostel/vUJjfBpGMwm1Pa6u83TdntXeUF2s4NJgTy9xMWMX.jpg',
            'created_at' => null,
            'updated_at' => '2023-11-19 06:04:31',
        ]);
        HostelRoomImages::create([
            'id' => 2,
            'hostel_id' => 2,
            'hostel_room_id' => 1,
            'image' => 'media/hostel/hpvQeN2TZgCF9e6AFCBSR1AuAjGFzcYFZz0BoOP2.jpg',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 3,
            'hostel_id' => 3,
            'hostel_room_id' => 2,
            'image' => 'media/hostel/yOipZhmMEVTxXSbu64vYWeay7A7wrTiZ612mwwh7.png',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 5,
            'hostel_id' => 3,
            'hostel_room_id' => 4,
            'image' => 'media/hostel/CBnePBZhQRrHB1sCVUTla2u51LOANmLZqT1qhJaa.png',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 6,
            'hostel_id' => 3,
            'hostel_room_id' => 5,
            'image' => 'media/hostel/Qqq7G1QOWL1u8AYBMeXK3UMe5kVupVA8sOSpSIOr.jpg',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 7,
            'hostel_id' => 4,
            'hostel_room_id' => 6,
            'image' => 'media/hostel/ChvC3VyyyZSGV9G6w3RxzGS7AYj0fR2Y3cA6RXrN.png',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 8,
            'hostel_id' => 4,
            'hostel_room_id' => 7,
            'image' => 'media/hostel/Erq7U0dimzAut1ougjBYG0huBd8iEIkm3Ak8xc78.png',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 9,
            'hostel_id' => 4,
            'hostel_room_id' => 8,
            'image' => 'media/hostel/sEZhcNQAC1anG6elevPVZDhv5I9mK7xIP8ActIZh.jpg',
            'created_at' => null,
            'updated_at' => null,
        ]);
        HostelRoomImages::create([
            'id' => 10,
            'hostel_id' => 4,
            'hostel_room_id' => 8,
            'image' => 'media/hostel/kMGjtkMakxfT7LOnmUtfkTCjVLG14fZms3measjC.jpg',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}

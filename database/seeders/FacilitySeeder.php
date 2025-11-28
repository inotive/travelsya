<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'id' => 10,
                'icon' => 'media/facilities/VYcGUPSdmIiWP7NvZCSKQ8e5wUCnpSpOec6yVu5Z.png',
                'name' => 'swimming pool',
                'created_at' => '2023-10-11 21:29:33',
                'updated_at' => '2023-10-11 21:29:33',
            ],
            [
                'id' => 11,
                'icon' => 'media/facilities/YRgjocLUqK6DymvkJrNWdFm9iA4bH3RCeVzLZzd9.png',
                'name' => 'breakfast',
                'created_at' => '2023-10-11 21:29:50',
                'updated_at' => '2023-10-11 21:29:50',
            ],
            [
                'id' => 12,
                'icon' => 'media/facilities/fcYXiVWJbtf06WMztmjHQZRnOESNTRxfMkjm0uuh.png',
                'name' => 'wifi',
                'created_at' => '2023-10-11 21:30:03',
                'updated_at' => '2023-10-11 21:30:03',
            ],
            [
                'id' => 14,
                'icon' => 'media/facilities/bZCCOr7ZoWBDrvSdOKFeap0oiqVqFMmygxB5WMUw.png',
                'name' => 'room',
                'created_at' => '2023-10-17 22:51:31',
                'updated_at' => '2023-10-17 22:51:31',
            ],
            [
                'id' => 15,
                'icon' => 'media/facilities/8FXqoMWw2z89omWxdlmGl1EeUUjgTIbhJ1h7vkdx.png',
                'name' => 'Person',
                'created_at' => '2023-10-17 22:51:50',
                'updated_at' => '2023-10-17 22:51:50',
            ],
            [
                'id' => 16,
                'icon' => 'media/facilities/0n3BwfIddrfuO5M8C01IY74rJRsXAek0JUlxVw4r.png',
                'name' => 'ac',
                'created_at' => '2023-10-18 18:00:40',
                'updated_at' => '2023-10-18 18:00:40',
            ],
            [
                'id' => 17,
                'icon' => 'media/facilities/zFtUqQSCOKTP096LCltyiiWl7QddxKksYkDPnllE.png',
                'name' => 'Restoran',
                'created_at' => '2023-10-18 18:01:11',
                'updated_at' => '2023-10-18 18:01:11',
            ],
            [
                'id' => 18,
                'icon' => 'media/facilities/iu6go9pPAczV39L3TRdZJ7cTh2B9590ir9WItja7.png',
                'name' => 'TV',
                'created_at' => '2023-10-18 18:01:22',
                'updated_at' => '2023-10-18 18:01:22',
            ],
            [
                'id' => 19,
                'icon' => 'media/facilities/6LHhXBVVGggrVMeVLCqfE18ubht6qyK9RHvq9PNf.png',
                'name' => 'kettel',
                'created_at' => '2023-10-18 18:01:49',
                'updated_at' => '2023-10-18 18:01:49',
            ],
        ];

        foreach ($facilities as $facilityData) {
            Facility::updateOrCreate(
                ['id' => $facilityData['id']], // Search by ID
                $facilityData // Create or update with this data
            );
        }
    }
}

<?php

namespace Database\Seeders;
use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'id' => 5,
                'name' => 'pulsa',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'data',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'pln',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'name' => 'telkom',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'name' => 'bpjs',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'name' => 'negara',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'name' => 'hostel',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'name' => 'hotel',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'name' => 'finance',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'name' => 'tv-internet',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'name' => 'ewallet',
                'deleted_at' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'name' => 'listrik-token',
                'deleted_at' => NULL,
                'created_at' => '2023-10-02 00:37:37',
                'updated_at' => '2023-10-02 00:37:38'
            ]
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['id' => $serviceData['id']], // Search by ID
                $serviceData // Create or update with this data
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Hostel;
use App\Models\HostelRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HostelRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HostelRule::create([
            'id' => 1,
            'hostel_id' => 2,
            'description' => 'Tidak boleh membawa binatang peliharaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRule::create([
            'id' => 2,
            'hostel_id' => 3,
            'description' => 'Tidak boleh membawa makanan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRule::create([
            'id' => 3,
            'hostel_id' => 2,
            'description' => 'Tidak boleh merokok di dalam kamar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRule::create([
            'id' => 4,
            'hostel_id' => 4,
            'description' => 'Tidak boleh membawa obat-obatan terlarang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        HostelRule::create([
            'id' => 5,
            'hostel_id' => 4,
            'description' => 'Tidak boleh membawa senjata tajam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FailedJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('failed_jobs')->insert([
            [
                'id' => 1,
                'uuid' => 'uuidTest1',
                'connection' => 'database',
                'queue' => 'queue1',
                'payload' => 'testPayload1',
                'exception' => 'testException1',
                'failed_at' => now()
            ],
            [
                'id' => 2,
                'uuid' => 'uuidTest2',
                'connection' => 'database',
                'queue' => 'queue2',
                'payload' => 'testPayload2',
                'exception' => 'testException2',
                'failed_at' => now()
            ],
            [
                'id' => 3,
                'uuid' => 'uuidTest3',
                'connection' => 'database',
                'queue' => 'queue3',
                'payload' => 'testPayload3',
                'exception' => 'testException3',
                'failed_at' => now()
            ],
            [
                'id' => 4,
                'uuid' => 'uuidTest4',
                'connection' => 'database',
                'queue' => 'queue4',
                'payload' => 'testPayload4',
                'exception' => 'testException4',
                'failed_at' => now()
            ],
            [
                'id' => 5,
                'uuid' => 'uuidTest5',
                'connection' => 'database',
                'queue' => 'queue5',
                'payload' => 'testPayload5',
                'exception' => 'testException5',
                'failed_at' => now()
            ],
        ]);
    }
}

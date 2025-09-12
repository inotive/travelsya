<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailTransactionCarRental;
use Carbon\Carbon;

class UpdateCarRentalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update semua booking dengan status 'pending' menjadi 'belum_dipakai'
        DetailTransactionCarRental::where('status', 'pending')->update(['status' => 'belum_dipakai']);
        
        // Update semua booking dengan status 'verified' tetap menjadi 'sudah_dipakai' (jika sudah ada)
        // Tidak perlu diubah karena sudah sesuai
        
        // Hitung waktu 6 jam yang lalu
        $sixHoursAgo = Carbon::now()->subHours(6);
        
        // Update semua booking dengan start_date sudah lewat 6 jam dan status 'belum_dipakai' menjadi 'kedaluwarsa'
        DetailTransactionCarRental::where('status', 'belum_dipakai')
            ->where('start', '<', $sixHoursAgo)
            ->update(['status' => 'kedaluwarsa']);
    }
}
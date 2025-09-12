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
        
        // Update semua booking dengan end_date sudah lewat dan status 'belum_dipakai' menjadi 'kedaluwarsa'
        DetailTransactionCarRental::where('status', 'belum_dipakai')
            ->where('end', '<', Carbon::now())
            ->update(['status' => 'kedaluwarsa']);
    }
}
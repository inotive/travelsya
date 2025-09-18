<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DetailTransactionCarRental;
use Carbon\Carbon;

class UpdateExpiredCarRentalBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car-rental:update-expired-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of car rental bookings to "kedaluwarsa" if start time is more than 6 hours ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating expired car rental bookings...');
        
        // Hitung waktu 6 jam yang lalu
        $sixHoursAgo = Carbon::now()->subHours(6);
        
        // Ambil semua booking dengan status 'belum_dipakai' dan start_date sudah lewat 6 jam
        $expiredBookings = DetailTransactionCarRental::where('status', 'belum_dipakai')
            ->where('start', '<', $sixHoursAgo)
            ->get();
            
        $count = $expiredBookings->count();
        
        if ($count > 0) {
            foreach ($expiredBookings as $booking) {
                $booking->status = 'kedaluwarsa';
                $booking->save();
            }
            
            $this->info("Successfully updated {$count} expired car rental bookings.");
        } else {
            $this->info('No expired car rental bookings found.');
        }
    }
}
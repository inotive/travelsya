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
    protected $description = 'Update status of expired car rental bookings to "kedaluwarsa"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating expired car rental bookings...');
        
        // Ambil semua booking dengan status 'belum_dipakai' dan end_date sudah lewat
        $expiredBookings = DetailTransactionCarRental::where('status', 'belum_dipakai')
            ->where('end', '<', Carbon::now())
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
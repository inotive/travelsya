<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarBookDate;
use App\Models\CarModel;
use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use App\Models\DetailTransactionCarRental;
use App\Models\DetailTransactionRecreation;
use App\Models\Recreation;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create or find the partner user
        $partnerUser = User::firstOrCreate(
            ['email' => 'mitra@gmail.com'],
            [
                'name' => 'Mitra Travelsya',
                'password' => Hash::make('password'),
                'role' => 1, // Role for Mitra
                'point' => 0,
                'is_active' => 1,
            ]
        );

        // 2. Create or find 10 customer users (5 regular + 5 expired)
        $customers = [];
        for ($i = 0; $i < 10; $i++) {
            $customers[] = User::firstOrCreate(
                ['email' => 'customer' . ($i + 1) . '@example.com'],
                [
                    'name' => 'Customer ' . ($i + 1),
                    'password' => Hash::make('password'),
                    'phone' => '08123456789' . $i,
                    'point' => 0,
                    'role' => 2, // Role for Customer
                    'is_active' => 1,
                ]
            );
        }

        // 3. Seed Car Rental Bookings
        $this->seedCarRentalBookings($partnerUser, $customers);

        // 4. Seed Recreation Bookings
        $this->seedRecreationBookings($partnerUser, $customers);
    }

    private function seedCarRentalBookings($partnerUser, $customers)
    {
        // Create or find a Car Rental owned by the partner
        $carRental = CarRental::firstOrCreate(
            ['business_name' => 'Sewa Mobil Maju Jaya'],
            [
                'user_id' => $partnerUser->id,
                'address' => 'Jl. Otomotif No. 1, Jakarta',
                'city' => 'Jakarta',
                'phone' => '081122334455',
                'is_active' => true,
            ]
        );

        // Create a car brand and model
        $brand = Brand::firstOrCreate(['name' => 'Toyota']);
        $carModel = CarModel::firstOrCreate(['name' => 'Avanza']);

        // Create or find a car for the rental
        $car = CarRentalHasCars::firstOrCreate(
            [
                'car_rental_id' => $carRental->id,
                'brand_id' => $brand->id,
                'car_model_id' => $carModel->id,
            ],
            [
                'policy_id' => 1,
                'number_seats' => 4,
                'category_rent' => 'Dengan Driver',
                'category' => 'manual',
                'rental_price_per_day' => 300000,
                'status' => '1',
                'description' => 'Mobil keluarga yang nyaman',
                'years' => '2023',
            ]
        );

        // Create 5 car rental bookings that are not yet verified (pending)
        foreach (array_slice($customers, 0, 5) as $key => $customer) {
            $booking_id = 'BOOK-CAR-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-CAR-' . $booking_id],
                [
                    'user_id' => $customer->id,
                    'service' => 'Car',
                    'service_id' => 1,
                    'payment' => 'onthespot',
                    'total' => 350000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionCarRental::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'car_rental_id' => $carRental->id,
                    'car_rental_has_car_id' => $car->id,
                    'location' => $carRental->city,
                    'start' => Carbon::now()->addDays($key + 1),
                    'end' => Carbon::now()->addDays($key + 3),
                    'rent_price' => 300000,
                    'fee_admin' => 50000,
                    'duration' => '2 Hari',
                    'kode_unik' => rand(100, 999),
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => $customer->phone,
                    'status' => 'pending', // Not yet verified
                ]
            );

            CarBookDate::create(
                [
                    'transaction_id' => $transaction->id,
                    'car_rental_has_car_id' => $car->id,
                    'start' => Carbon::now()->addDays($key + 1),
                    'end' => Carbon::now()->addDays($key + 3),
                ]
            );
        }

        // Create 5 car rental bookings that are expired
        foreach (array_slice($customers, 5, 5) as $key => $customer) {
            // Adjust key to start from 0 for the slice
            $adjustedKey = $key - 5;

            $booking_id = 'BOOK-CAR-EXP-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-CAR-EXP-' . $booking_id],
                [
                    'user_id' => $customer->id,
                    'service' => 'Car',
                    'service_id' => 1,
                    'payment' => 'onthespot',
                    'total' => 350000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionCarRental::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'car_rental_id' => $carRental->id,
                    'car_rental_has_car_id' => $car->id,
                    'location' => $carRental->city,
                    'start' => Carbon::now()->subDays(30 + $adjustedKey), // Expired 30+ days ago
                    'end' => Carbon::now()->subDays(28 + $adjustedKey), // Expired 28+ days ago
                    'rent_price' => 300000,
                    'fee_admin' => 50000,
                    'duration' => '2 Hari',
                    'kode_unik' => rand(100, 999),
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => $customer->phone,
                    'status' => 'expired', // Expired status
                ]
            );

            CarBookDate::create(
                [
                    'transaction_id' => $transaction->id,
                    'car_rental_has_car_id' => $car->id,
                    'start' => Carbon::now()->subDays(30 + $adjustedKey),
                    'end' => Carbon::now()->subDays(28 + $adjustedKey),
                ]
            );
        }
    }

    private function seedRecreationBookings($partnerUser, $customers)
    {
        // Create or find a Recreation owned by the partner
        $recreation = Recreation::firstOrCreate(
            ['business_name' => 'Taman Hiburan Gembira'],
            [
                'user_id' => $partnerUser->id,
                'category_recreation_id' => 1,
                'phone' => '081298765432',
                'city' => 'Bandung',
                'address' => 'Jl. Bahagia No. 1',
                'is_active' => true,
            ]
        );

        // Create 5 recreation bookings
        foreach (array_slice($customers, 0, 5) as $key => $customer) {
            $booking_id = 'BOOK-REC-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-REC-' . $booking_id],
                [
                    'user_id' => $customer->id,
                    'service' => 'Recreation',
                    'service_id' => 2,
                    'payment' => 'onthespot',
                    'total' => 105000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionRecreation::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'recreation_id' => $recreation->id,
                    'recreationPackage_id' => 1,
                    'expire_on' => Carbon::now()->addDays(30 + $key),
                    'rent_price' => '100000',
                    'fee_admin' => '5000',
                    'kode_unik' => rand(100, 999),
                    'is_used' => 0,
                ]
            );
        }

        // Create 5 expired recreation bookings
        for ($i = 0; $i < 5; $i++) {
            $expiredCustomer = User::firstOrCreate(
                ['email' => 'expiredcustomer' . ($i + 1) . '@example.com'],
                [
                    'name' => 'Expired Customer ' . ($i + 1),
                    'password' => Hash::make('password'),
                    'phone' => '08123456788' . $i,
                    'point' => 0,
                    'role' => 2, // Role for Customer
                    'is_active' => 1,
                ]
            );

            $booking_id = 'BOOK-REC-EXP-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-REC-EXP-' . $booking_id],
                [
                    'user_id' => $expiredCustomer->id,
                    'service' => 'Recreation',
                    'service_id' => 2,
                    'payment' => 'onthespot',
                    'total' => 105000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionRecreation::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'recreation_id' => $recreation->id,
                    'recreationPackage_id' => 1,
                    'expire_on' => Carbon::now()->subDays(rand(1, 30)), // Expired 1-30 days ago
                    'rent_price' => '100000',
                    'fee_admin' => '5000',
                    'kode_unik' => rand(100, 999),
                    'is_used' => 0,
                ]
            );
        }
    }
}

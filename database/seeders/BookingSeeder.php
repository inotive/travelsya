<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BusBooked;
use App\Models\BusDeparture;
use App\Models\BusTravels;
use App\Models\BusTravelHasBus;
use App\Models\CarBookDate;
use App\Models\CarModel;
use App\Models\CarRental;
use App\Models\CarRentalHasCars;
use App\Models\DetailTransactionBus;
use App\Models\DetailTransactionCarRental;
use App\Models\detailTransactionRecreation;
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

        // 2. Create or find 5 customer users
        $customers = [];
        for ($i = 0; $i < 5; $i++) {
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

        // 5. Seed Bus Travel Bookings
        $this->seedBusTravelBookings($partnerUser, $customers);
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
                'duration' => '1 Hari',
                'status' => '1',
                'description' => 'Mobil keluarga yang nyaman',
                'years' => '2023',
            ]
        );

        // Create 5 car rental bookings
        foreach ($customers as $key => $customer) {
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
                    'status' => 'pending',
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
        foreach ($customers as $key => $customer) {
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

            detailTransactionRecreation::firstOrCreate(
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
    }

    private function seedBusTravelBookings($partnerUser, $customers)
    {
        // Create or find a Bus Travel company owned by the partner
        $busTravel = BusTravels::firstOrCreate(
            ['business_name' => 'PO Travelsya'],
            [
                'user_id' => $partnerUser->id,
                'city' => 'Jakarta',
                'phone' => '081122334456',
                'address' => 'Jl. Angkasa No. 1, Jakarta',
                'is_active' => true,
            ]
        );

        // Create a bus for the travel company
        $bus = BusTravelHasBus::firstOrCreate(
            [
                'bus_travel_id' => $busTravel->id,
            ],
            [
                'name' => 'Bus AC VIP',
                'tos' => 'Terms of service for bus travel',
                'number_seats' => 40,
                'class' => 'Executive',
                'is_active' => true,
            ]
        );

        // Create a bus departure route (Jakarta to Bandung)
        $departure = BusDeparture::firstOrCreate(
            [
                'bus_travel_has_bus_id' => $bus->id,
                'from_city_id' => 1, // Jakarta (using placeholder ID)
                'to_city_id' => 2,   // Bandung (using placeholder ID)
            ],
            [
                'departure_time' => '08:00:00',
                'titik_naik' => 'Terminal Lebak Bulus',
                'titik_turun' => 'Terminal Bandung',
                'duration' => 180, // 3 hours in minutes
                'days' => '1,2,3,4,5,6,0', // Everyday
                'price' => 100000,
            ]
        );

        // Create 5 bus travel bookings
        foreach ($customers as $key => $customer) {
            $booking_id = 'BOOK-BUS-' . Str::random(8);
            $transaction = Transaction::firstOrCreate(
                ['no_inv' => 'TRX-BUS-' . $booking_id],
                [
                    'user_id' => $customer->id,
                    'service' => 'Bus',
                    'service_id' => 3,
                    'payment' => 'onthespot',
                    'total' => 105000,
                    'status' => 'PAID',
                ]
            );

            DetailTransactionBus::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'transaction_id' => $transaction->id,
                    'bus_travel_id' => $busTravel->id,
                    'bus_travel_has_bus_id' => $bus->id,
                    'bus_departure_id' => $departure->id,
                    'departure_time' => Carbon::now()->addDays($key + 1)->setTime(8, 0, 0),
                    'from' => 'KABUPATEN SIMEULUE',
                    'to' => 'KABUPATEN ACEH SINGKIL',
                    'price' => 100000,
                    'fee_admin' => 5000,
                    'duration' => '03:00:00',
                    'kode_unik' => rand(100, 999),
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => $customer->phone,
                ]
            );

            BusBooked::create(
                [
                    'transaction_id' => $transaction->id,
                    'bus_travel_id' => $busTravel->id,
                    'bus_travel_has_bus_id' => $bus->id,
                    'bus_departure_id' => $departure->id,
                    'customer_name' => $customer->name,
                    'customer_phone' => $customer->phone,
                    'customer_email' => $customer->email,
                    'departure_time' => Carbon::now()->addDays($key + 1)->setTime(8, 0, 0),
                ]
            );
        }
    }
}

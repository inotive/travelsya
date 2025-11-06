<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            ProductSeeder::class,
            SettingSeeder::class,
            SpecialistSeeder::class,
            CategoriesServicesSeeder::class,
            CategoryRecreationSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            TransactionSeeder::class,
            AdsSeeder::class,
            BrandSeeder::class,
            CarModelSeeder::class,
            CarRentalSeeder::class,
            FacilitySeeder::class,
            HostelSeeder::class,
            HostelRoomSeeder::class,
            BookDateSeeder::class,
            HostelRoomImageSeeder::class,
            HostelRoomFacilitySeeder::class,
            HostelRatingSeeder::class,
            HostelImageSeeder::class,
            HostelRuleSeeder::class,
            CitiesSeeder::class,
            HotelSeeder::class,
            HotelImageSeeder::class,
            HotelRoomSeeder::class,
            HotelBookDateSeeder::class,
            HotelRoomImageSeeder::class,
            HotelRoomFacilitySeeder::class,
            HotelRuleSeeder::class,
            HotelRatingSeeder::class,
            RatingSeeder::class,
            RatingFotoSeeder::class,
            PointSeeder::class,
            PersonalAccessTokenSeeder::class,
            PasswordResetTokenSeeder::class,
            PasswordResetSeeder::class,
            HistoryPointSeeder::class,
            HelpSeeder::class,
            GuestSeeder::class,
            FeeSeeder::class,
            FailedJobsSeeder::class,
            DetailTransactionTopUpSeeder::class,
            DetailTransactionPPOBSeeder::class,
            DetailTransactionHotelSeeder::class,
            DetailTransactionHostelSeeder::class,
            PolicySeeder::class,
            RecreationsSeeder::class,
            RecreationHasPackagesSeeder::class,
            CarRentalHasCarsSeeder::class,
            ClinicSeeder::class,
            ClinicHasPackagesSeeder::class,
            ClinicImagesSeeder::class,
            ClinicRatingsSeeder::class,
            ClinicPackageImagesSeeder::class,
            HealthBeautyPackageSeeder::class,
            HealthBeautyTransactionSeeder::class,
            BookingSeeder::class,
            BusDepartureSeeder::class,
            BusRouteSeeder::class,
            BusTravelHasBusSeeder::class,
            BusFacilitySeeder::class,
        ]);
    }
}

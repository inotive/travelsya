<?php

use App\Models\RecreationPackagesImages;
use Faker\Factory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recreation_packages_images', function (Blueprint $table) {
            //
        });

        $faker = Factory::create();

        foreach (range(1, 24) as $index) {
            DB::table('recreation_packages_images')->insert([
                'recreation_package_id' => $faker->numberBetween(1, 6),
                'image' => 'images/not_found.jpg',
                'main' => 0,
            ]);
        }

        $satu =  RecreationPackagesImages::where('recreation_package_id', 1)->first();
        $satu->main = 1;
        $satu->save();

        $dua =  RecreationPackagesImages::where('recreation_package_id', 2)->first();
        $dua->main = 1;
        $dua->save();

        $tiga =  RecreationPackagesImages::where('recreation_package_id', 3)->first();
        $tiga->main = 1;
        $tiga->save();

        $empat =  RecreationPackagesImages::where('recreation_package_id', 4)->first();
        $empat->main = 1;
        $empat->save();

        $lima =  RecreationPackagesImages::where('recreation_package_id', 5)->first();
        $lima->main = 1;
        $lima->save();

        $enam =  RecreationPackagesImages::where('recreation_package_id', 6)->first();
        $enam->main = 1;
        $enam->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recreation_packages_images', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bus_travel_has_facilities', function (Blueprint $table) {
            //
        });

        $items = [
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 1,
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 2,
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 3,
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 4,
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 5,
            ],
            [
                'bus_travel_has_bus_id' => 1,
                'bus_facility_id' => 6,
            ],
        ];

        foreach ($items as $item) {
            \App\Models\BusTravelHasFacility::create($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_travel_has_facilities', function (Blueprint $table) {
            //
        });
    }
};

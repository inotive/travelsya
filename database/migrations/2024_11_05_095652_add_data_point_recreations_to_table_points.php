<?php

use App\Models\Point;
use App\Models\Service;
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
        Schema::table('points', function (Blueprint $table) {
            //
        });

        $recreation = Service::where('name', 'recreation')->first();
        if ($recreation) {
            Point::create([
                'service_id' => $recreation['id'],
                'multiple' => 10000,
                'value' => 10,
            ]);
        }

        $health = Service::where('name', 'health-beauty')->first();
        if ($health) {
            Point::create([
                'service_id' => $health['id'],
                'multiple' => 10000,
                'value' => 10,
            ]);
        }

        $car = Service::where('name', 'car-rent')->first();
        if ($car) {
            Point::create([
                'service_id' => $car['id'],
                'multiple' => 10000,
                'value' => 10,
            ]);
        }

        $bus = Service::where('name', 'bus-travel')->first();
        if ($bus) {
            Point::create([
                'service_id' => $bus['id'],
                'multiple' => 10000,
                'value' => 10,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('points', function (Blueprint $table) {
            //
        });
    }
};

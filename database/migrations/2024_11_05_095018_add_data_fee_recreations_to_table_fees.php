<?php

use App\Models\Fee;
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
        Schema::table('fees', function (Blueprint $table) {
            //
        });

        $recreation = Service::where('name', 'recreation')->first();
        if ($recreation) {
            Fee::create([
                'service_id' => $recreation['id'],
                'value' => 0,
                'percent' => 0,
            ]);
        }

        $health = Service::where('name', 'health-beauty')->first();
        if ($health) {
            Fee::create([
                'service_id' => $health['id'],
                'value' => 0,
                'percent' => 0,
            ]);
        }

        $car = Service::where('name', 'car-rent')->first();
        if ($car) {
            Fee::create([
                'service_id' => $car['id'],
                'value' => 0,
                'percent' => 0,
            ]);
        }

        $bus = Service::where('name', 'bus-travel')->first();
        if ($bus) {
            Fee::create([
                'service_id' => $bus['id'],
                'value' => 0,
                'percent' => 0,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            //
        });
    }
};

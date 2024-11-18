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
        Schema::create('bus_departures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bus_travel_has_bus_id');
            $table->dateTime('departure_time');
            $table->bigInteger('from_route_id');
            $table->bigInteger('to_route_id');
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_departures');
    }
};

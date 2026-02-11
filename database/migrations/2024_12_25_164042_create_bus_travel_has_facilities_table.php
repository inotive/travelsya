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
        Schema::create('bus_travel_has_facilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bus_travel_has_bus_id')->unsigned();
            $table->bigInteger('bus_facility_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_travel_has_facilities');
    }
};

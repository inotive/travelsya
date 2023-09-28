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
        Schema::create('hostel_room_facilities', function (Blueprint $table) {
            $table->unsignedBigInteger('hostel_id');
            $table->unsignedBigInteger('hostel_room_id');
            $table->unsignedBigInteger('facility_id');

            $table->foreign('hostel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('hostel_room_id')->references('id')->on('hotel_rooms')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_room_facilities');
    }
};

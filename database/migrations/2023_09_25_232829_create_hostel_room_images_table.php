<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hostel_room_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostel_id');
            $table->unsignedBigInteger('hostel_room_id');
            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
            $table->foreign('hostel_room_id')->references('id')->on('hostel_rooms')->onDelete('cascade');

            $table->longText('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostel_room_images');
    }
};

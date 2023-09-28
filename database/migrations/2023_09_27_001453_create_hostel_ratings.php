<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hostel_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostel_id');
            $table->unsignedBigInteger('hostel_room_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('hostel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('hostel_room_id')->references('id')->on('hotel_rooms')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rate');
            $table->longText('comment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('');
    }
};

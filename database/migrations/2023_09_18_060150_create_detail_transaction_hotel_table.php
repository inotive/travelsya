<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaction_hotel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('hotel_room_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('hotel_room_id')->references('id')->on('hotel_rooms')->onDelete('cascade');
            $table->string('booking_id');
            $table->date('reservation_start');
            $table->date('reservation_end');
            $table->integer('guest');
            $table->integer('room');
            $table->integer('rent_price');
            $table->integer('fee_admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_hotel');
    }
};

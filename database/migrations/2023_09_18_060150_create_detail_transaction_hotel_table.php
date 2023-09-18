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
            $table->foreignId('transaction_id');
            $table->foreignId('hotel_id');
            $table->foreignId('hotel_room_id');
            $table->string('booking_id');
            $table->date('reservation_start');
            $table->date('reservation_date');
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
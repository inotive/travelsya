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
        Schema::create('detail_transaction_car_rentals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('car_rental_id');
            $table->bigInteger('car_rental_has_car_id');
            $table->string('booking_id');
            $table->string('location');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('rent_price');
            $table->integer('fee_admin');
            $table->string('duration');
            $table->integer('kode_unik');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_car_rentals');
    }
};

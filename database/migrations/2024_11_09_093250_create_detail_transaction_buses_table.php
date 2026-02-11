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
        Schema::create('detail_transaction_buses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('bus_travel_id');
            $table->bigInteger('bus_travel_has_bus_id');
            $table->string('booking_id');
            $table->dateTime('departure_time');
            $table->string('from');
            $table->string('to');
            $table->bigInteger('price');
            $table->bigInteger('fee_admin')->nullable();
            $table->string('duration')->nullable();
            $table->string('kode_unik')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_buses');
    }
};

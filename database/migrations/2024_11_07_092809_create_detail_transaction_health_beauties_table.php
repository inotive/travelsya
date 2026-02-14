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
        Schema::create('detail_transaction_health_beauties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('clinic_id');
            $table->bigInteger('clinic_package_id');
            $table->bigInteger('category');
            $table->string('booking_id');
            $table->string('expire_on');
            $table->string('rent_price');
            $table->string('total_ticket');
            $table->string('fee_admin');
            $table->string('kode_unik');
            $table->string('is_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_health_beauties');
    }
};

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
        Schema::create('detail_transaction_recreations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('recreation_id');
            $table->bigInteger('recreationPackage_id');
            $table->string('booking_id');
            $table->dateTime('expire_on');
            $table->string('rent_price');
            $table->string('fee_admin');
            $table->string('kode_unik');
            $table->boolean('is_used')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_recreations');
    }
};

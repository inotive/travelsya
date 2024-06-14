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
        Schema::create('detail_order_clinics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');

            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics');

            $table->unsignedBigInteger('clinic_has_package_id');
            $table->foreign('clinic_has_package_id')->references('id')->on('clinic_has_packages')->onDelete('cascade');

            $table->date('expiry_date');
            $table->integer('price');
            $table->integer('fee_admin');
            $table->string('unique_code');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_order_clinics');
    }
};

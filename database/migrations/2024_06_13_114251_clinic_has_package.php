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
        Schema::create('clinic_has_packages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

            $table->unsignedBigInteger('categories_services_id');
            $table->foreign('categories_services_id')->references('id')->on('categories_services')->onDelete('cascade');

            $table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade');

            $table->string('name');
            $table->text('rules');
            $table->text('description');
            $table->string('duration');
            $table->date('expiry_date');
            $table->string("unit_price");
            $table->double('price');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

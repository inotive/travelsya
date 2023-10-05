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
        Schema::table('hostel_rooms', function (Blueprint $table) {
            $table->integer('rentprice_monthly');
            $table->integer('sellingrentprice_monthly');
            $table->integer('rentprice_yearly');
            $table->integer('sellingrentprice_yearly');
            $table->integer('totalbathroom');
            $table->integer('extrabed_sellingprice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hostel_rooms', function (Blueprint $table) {
            $table->integer('price');
            $table->integer('sellingprice');
        });
    }
};

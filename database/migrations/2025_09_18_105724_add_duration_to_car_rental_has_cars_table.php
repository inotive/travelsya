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
        Schema::table('car_rental_has_cars', function (Blueprint $table) {
            $table->string('duration')->nullable()->after('rental_price_per_day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_rental_has_cars', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};

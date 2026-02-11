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
        Schema::table('clinic_has_packages', function (Blueprint $table) {
            $table->enum('discount_type', ['flat', 'percent'])->default('flat');
            $table->bigInteger('discount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinic_has_packages', function (Blueprint $table) {
            //
        });
    }
};

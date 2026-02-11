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
        Schema::table('recreation_has_packages', function (Blueprint $table) {
            $table->boolean('is_refundable')->default(0);
            $table->boolean('is_reschedule')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recreation_has_packages', function (Blueprint $table) {
            //
        });
    }
};

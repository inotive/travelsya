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
        Schema::table('bus_travel_has_buses', function (Blueprint $table) {
            $table->longtext('deskripsi')->nullable();
            $table->string('kategori')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_travel_has_buses', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('kategori');
        });
    }
};

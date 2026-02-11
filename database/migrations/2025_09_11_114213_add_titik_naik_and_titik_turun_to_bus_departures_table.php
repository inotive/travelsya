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
        Schema::table('bus_departures', function (Blueprint $table) {
            $table->renameColumn('from_route_id', 'from_city_id');
            $table->renameColumn('to_route_id', 'to_city_id');
            $table->string('titik_naik');
            $table->string('titik_turun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bus_departures', function (Blueprint $table) {
            $table->renameColumn('from_city_id', 'from_route_id');
            $table->renameColumn('to_city_id', 'to_route_id');
            $table->dropColumn('titik_naik');
            $table->dropColumn('titik_turun');
        });
    }
};

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
            $table->string('duration_unit')->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recreation_has_packages', function (Blueprint $table) {
            $table->dropColumn('duration_unit');
        });
    }
};

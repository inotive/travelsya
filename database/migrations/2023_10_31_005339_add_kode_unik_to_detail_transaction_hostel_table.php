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
        Schema::table('detail_transaction_hostel', function (Blueprint $table) {
            $table->unsignedInteger('kode_unik')->after('fee_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaction_hostel', function (Blueprint $table) {
            $table->dropColumn('kode_unik');
        });
    }
};

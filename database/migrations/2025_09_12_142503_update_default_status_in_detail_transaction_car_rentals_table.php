<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom status.
     */
    public function up(): void
    {
        Schema::table('detail_transaction_car_rentals', function (Blueprint $table) {
            $table->string('status')->default('belum_dipakai')->after('id');
        });
    }

    /**
     * Menghapus kolom status (kebalikan dari 'up').
     */
    public function down(): void
    {
        Schema::table('detail_transaction_car_rentals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

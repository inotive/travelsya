<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('detail_transaction_top_up', function (Blueprint $table) {
            $table->string('kode_voucher');
        });
    }

    public function down(): void
    {
        Schema::table('detail_transaction_top_up', function (Blueprint $table) {
            //
        });
    }
};

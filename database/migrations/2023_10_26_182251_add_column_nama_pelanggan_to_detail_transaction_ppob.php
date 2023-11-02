<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('detail_transaction_ppob', function (Blueprint $table) {
            $table->string('nama_pelanggan')->after('product_id');
        });
    }
};

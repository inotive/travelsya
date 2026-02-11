<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('detail_transaction_hotel', function (Blueprint $table) {
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_handphone');
        });
    }
};

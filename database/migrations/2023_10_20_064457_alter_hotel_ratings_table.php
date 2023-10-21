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
        Schema::table('hotel_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id')->after('users_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_ratings', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->after('id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            //
        });
    }
};

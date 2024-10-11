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
        Schema::create('recreations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('category_recreation_id');
            $table->foreign('category_recreation_id')->references('id')->on('category_recreations')->onDelete('cascade');

            $table->string('business_name');
            $table->string('phone');
            $table->string('city');
            $table->string('address');
            $table->double("lat") ->nullable();
            $table->double("ltd") ->nullable();
            $table->boolean('is_active');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recreations');
    }
};

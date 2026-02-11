<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('sellingprice');
            $table->string('bed_type')->nullable();
            $table->integer('roomsize')->nullable();
            $table->integer('maxextrabed')->nullable();
            $table->integer('totalroom')->nullable();
            $table->integer('guest')->nullable();
            $table->integer('is_active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_rooms');
    }
};

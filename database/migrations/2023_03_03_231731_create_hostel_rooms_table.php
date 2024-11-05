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
        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostel_id');
            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');

            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('sellingprice');
            $table->string('bed_type')->nullable();
            $table->string('max_guest')->comment('Maximal Guest');
            $table->integer('roomsize')->nullable();
            $table->integer('maxextrabed')->nullable();
            $table->integer('extrabedprice')->nullable();
            $table->integer('totalroom');
            $table->string('roomtype')->nullable();
            $table->string('furnish')->nullable();
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
        Schema::dropIfExists('hostel_rooms');
    }
};

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
        
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('city')->nullable();
            $table->string('kecamatan')->nullable();
            // $table->integer('price')->nullable();
            $table->text('address')->nullable();
            $table->text('facilities')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            // $table->string('category')->nullable(); //harian|bulanan
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->integer('star')->nullable();
            $table->boolean('is_active');
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
        Schema::dropIfExists('hostels');
    }
};

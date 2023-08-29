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
        
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('facilities')->nullable();
            $table->text('lat')->nullable();
            $table->text('lon')->nullable();
            $table->string('category')->nullable(); //harian|bulanan
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('website')->nullable();
            $table->string('star')->nullable();
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

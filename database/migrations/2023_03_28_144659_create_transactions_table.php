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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_inv')->unique();
            $table->string('req_id')->nullable(); //id xendit
            $table->string('link', 125)->nullable(); //link payout
            $table->string('service', 20); 
            $table->foreignId('service_id')->constrained();//type of service
            $table->enum('payment', ['xendit', 'finpay', 'onthespot']); //type of payment
            $table->string('payment_method')->nullable();
            $table->binary('payment_channel')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('status', 20);
            $table->integer('total');
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
        Schema::dropIfExists('transactions');
    }
};

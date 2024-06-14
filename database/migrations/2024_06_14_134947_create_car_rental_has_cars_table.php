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
        Schema::create('car_rental_has_cars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('car_rental_id');
            $table->foreign('car_rental_id')->references('id')->on('car_rentals')->onDelete('cascade');


            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->unsignedBigInteger('car_model_id');
            $table->foreign('car_model_id')->references('id')->on('car_models');


            $table->unsignedBigInteger('policy_id');
            $table->foreign('policy_id')->references('id')->on('policies');

            $table->integer("number_seats");
            $table->string('category_rent');
            $table->enum("category", ["manual", "automatic"]);
            $table->float("rental_price_per_day");
            $table->string("status");
            $table->text("description");
            $table->string("image_url");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rental_has_cars');
    }
};

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
        Schema::create('bus_travel_has_buses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bus_travel_id');
            $table->string('name');
            $table->longtext('tos');
            $table->integer('number_seats');
            $table->string('class');
            $table->boolean('is_active')->default(1);
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_travel_has_buses');
    }
};

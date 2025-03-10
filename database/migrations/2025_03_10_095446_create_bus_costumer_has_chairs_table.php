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
        Schema::create('bus_costumer_has_chairs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_costumer');
            $table->integer('id_bus_travel')->nullable();
            $table->integer('id_departure')->nullable();
            $table->date('date_pergi')->nullable();
            $table->date('date_pulang')->nullable();
            $table->integer('kursi_pergi')->nullable();
            $table->integer('kursi_pulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_costumer_has_chairs');
    }
};

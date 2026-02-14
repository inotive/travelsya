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
            $table->integer('id_departure');
            $table->integer('penumpang_ke');
            $table->boolean('is_pulang_pergi')->default(false);
            $table->date('date_pergi');
            $table->date('date_pulang')->nullable();
            $table->string('kursi_pergi');
            $table->string('kursi_pulang')->nullable();
            $table->boolean('is_active')->default(true);
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

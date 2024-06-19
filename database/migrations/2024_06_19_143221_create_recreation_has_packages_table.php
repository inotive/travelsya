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
        Schema::create('recreation_has_packages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('recreaction_id');
            $table->foreign('recreaction_id')->references('id')->on('recreations')->onDelete('cascade');

            $table->unsignedBigInteger('category_recreation_id');
            $table->foreign('category_recreation_id')->references('id')->on('category_recreations')->onDelete('cascade');


            $table->string("name");
            $table->text("rules");
            $table->text("description");
            $table->string("duration");
            $table->double("lat");
            $table->double("ltd");
            $table->date('expiry_date');
            $table->string("unit_price");
            $table->double('price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recreation_has_packages');
    }
};

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

            $table->unsignedBigInteger('recreation_id');
            $table->foreign('recreation_id')->references('id')->on('recreations')->onDelete('cascade');

            $table->unsignedBigInteger('category_recreation_id');
            $table->foreign('category_recreation_id')->references('id')->on('category_recreations')->onDelete('cascade');


            $table->string("name");
            $table->text("rules");
            $table->text("description");
            $table->string("duration");
            $table->integer("expiry_date");
            $table->enum("expiry_type", ["Hari", "Jam"]);
            $table->string("unit_price");
            $table->double("price");
            $table->boolean("is_active");

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

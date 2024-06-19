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
        Schema::create('package_has_discount', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('recreation_has_package_id');
            $table->foreign('recreation_has_package_id')->references('id')->on('recreation_has_packages')->onDelete('cascade');

            $table->unsignedBigInteger('recreation_id');
            $table->foreign('recreation_id')->references('id')->on('recreations')->onDelete('cascade');

            $table->unsignedBigInteger('category_recreation_id');
            $table->foreign('category_recreation_id')->references('id')->on('category_recreations')->onDelete('cascade');

            $table->date('start_date');
            $table->date('end_date');

            $table->enum("discount_type", ["percentage", "rupiah"]);
            $table->float("discount_value");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_has_discount');
    }
};

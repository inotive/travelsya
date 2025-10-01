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
        // Check if the columns exist before attempting to change them
        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'unit_price')) {
            Schema::table('clinic_has_packages', function (Blueprint $table) {
                $table->decimal('unit_price', 15, 0)->change();
            });
        }
        
        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'price')) {
            // The price column should also be changed if it's not already decimal
            Schema::table('clinic_has_packages', function (Blueprint $table) {
                $table->decimal('price', 15, 0)->change();
            });
        }
        
        // Change unit_price from string to decimal in recreation_has_packages table if it exists
        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'unit_price')) {
            Schema::table('recreation_has_packages', function (Blueprint $table) {
                $table->decimal('unit_price', 15, 0)->change();
            });
        }
        
        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'price')) {
            Schema::table('recreation_has_packages', function (Blueprint $table) {
                $table->decimal('price', 15, 0)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'unit_price')) {
            Schema::table('clinic_has_packages', function (Blueprint $table) {
                $table->string('unit_price')->change();
            });
        }
        
        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'price')) {
            Schema::table('clinic_has_packages', function (Blueprint $table) {
                $table->double('price')->change();
            });
        }
        
        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'unit_price')) {
            Schema::table('recreation_has_packages', function (Blueprint $table) {
                $table->string('unit_price')->change();
            });
        }
        
        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'price')) {
            Schema::table('recreation_has_packages', function (Blueprint $table) {
                $table->string('price')->change();
            });
        }
    }
};

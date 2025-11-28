<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (Schema::hasTable('clinic_has_packages')) {
            // First, update non-numeric values to 0, then handle NULL and empty strings
            DB::statement("UPDATE clinic_has_packages SET unit_price = 0 WHERE TRIM(unit_price) != '' AND TRIM(unit_price) REGEXP '^[0-9.]+$' = 0");
            DB::statement("UPDATE clinic_has_packages SET price = 0 WHERE TRIM(price) != '' AND TRIM(price) REGEXP '^[0-9.]+$' = 0");

            // Then update NULL and empty string values to 0
            DB::statement("UPDATE clinic_has_packages SET unit_price = 0 WHERE unit_price IS NULL OR TRIM(unit_price) = ''");
            DB::statement("UPDATE clinic_has_packages SET price = 0 WHERE price IS NULL OR TRIM(price) = ''");
        }

        if (Schema::hasTable('recreation_has_packages')) {
            // Clean non-numeric values in recreation_has_packages table as well
            DB::statement("UPDATE recreation_has_packages SET unit_price = 0 WHERE TRIM(unit_price) != '' AND TRIM(unit_price) REGEXP '^[0-9.]+$' = 0");
            DB::statement("UPDATE recreation_has_packages SET price = 0 WHERE TRIM(price) != '' AND TRIM(price) REGEXP '^[0-9.]+$' = 0");

            // Then update NULL and empty string values to 0
            DB::statement("UPDATE recreation_has_packages SET unit_price = 0 WHERE unit_price IS NULL OR TRIM(unit_price) = ''");
            DB::statement("UPDATE recreation_has_packages SET price = 0 WHERE price IS NULL OR TRIM(price) = ''");
        }

        // Check if the columns exist before attempting to change them
        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'unit_price')) {
            DB::statement('ALTER TABLE clinic_has_packages MODIFY unit_price DECIMAL(15, 0) DEFAULT 0');
        }

        if (Schema::hasTable('clinic_has_packages') && Schema::hasColumn('clinic_has_packages', 'price')) {
            // The price column should also be changed if it's not already decimal
            DB::statement('ALTER TABLE clinic_has_packages MODIFY price DECIMAL(15, 0) DEFAULT 0');
        }

        // Change unit_price from string to decimal in recreation_has_packages table if it exists
        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'unit_price')) {
            DB::statement('ALTER TABLE recreation_has_packages MODIFY unit_price DECIMAL(15, 0) DEFAULT 0');
        }

        if (Schema::hasTable('recreation_has_packages') && Schema::hasColumn('recreation_has_packages', 'price')) {
            DB::statement('ALTER TABLE recreation_has_packages MODIFY price DECIMAL(15, 0) DEFAULT 0');
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

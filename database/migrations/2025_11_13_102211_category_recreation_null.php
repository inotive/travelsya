
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
        Schema::table('recreations', function (Blueprint $table) {
            // Make all optional fields nullable
            $table->unsignedBigInteger('category_recreation_id')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->decimal('lat', 10, 8)->nullable()->change();
            $table->decimal('ltd', 11, 8)->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->time('open')->nullable()->change();
            $table->time('close')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recreations', function (Blueprint $table) {
            // Revert back to NOT NULL (be careful with existing data)
            $table->unsignedBigInteger('category_recreation_id')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->decimal('lat', 10, 8)->nullable(false)->change();
            $table->decimal('ltd', 11, 8)->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->time('open')->nullable(false)->change();
            $table->time('close')->nullable(false)->change();
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('health_beauty_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('validity_days')->default(30);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('health_beauty_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained('health_beauty_packages')->onDelete('cascade');
            $table->decimal('total_price', 15, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->date('purchase_date');
            $table->date('expiry_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_beauty_transactions');
        Schema::dropIfExists('health_beauty_packages');
    }
};
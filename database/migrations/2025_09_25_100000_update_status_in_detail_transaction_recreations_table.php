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
        Schema::table('detail_transaction_recreations', function (Blueprint $table) {
            $table->string('status')->default('belum_dipakai')->after('is_used');
        });

        // Migrate data from is_used to status
        DB::table('detail_transaction_recreations')->where('is_used', 1)->update(['status' => 'sudah_dipakai']);
        DB::table('detail_transaction_recreations')->where('is_used', 0)->update(['status' => 'belum_dipakai']);

        // Update expired bookings
        DB::table('detail_transaction_recreations')
            ->where('expire_on', '<', now())
            ->where('status', 'belum_dipakai')
            ->update(['status' => 'kadaluwarsa']);

        Schema::table('detail_transaction_recreations', function (Blueprint $table) {
            $table->dropColumn('is_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaction_recreations', function (Blueprint $table) {
            $table->boolean('is_used')->default(0)->after('status');
        });

        // Migrate data back from status to is_used
        DB::table('detail_transaction_recreations')->where('status', 'sudah_dipakai')->update(['is_used' => 1]);
        DB::table('detail_transaction_recreations')->where('status', '!=', 'sudah_dipakai')->update(['is_used' => 0]);

        Schema::table('detail_transaction_recreations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

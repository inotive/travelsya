<?php

use App\Models\BusFacility;
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
        Schema::table('table_bus_facilities', function (Blueprint $table) {
            //
        });

        $items = [
            [
                'name' => 'Colokan USB'
            ],
            [
                'name' => 'Peraturan kursi 1 - 1'
            ],
            [
                'name' => 'Lampu Baca'
            ],
            [
                'name' => 'Full AC'
            ],
            [
                'name' => 'Alat Pemadam'
            ],
            [
                'name' => 'Kursi Recliner'
            ],
        ];

        foreach ($items as $item) {
            BusFacility::create($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_bus_facilities', function (Blueprint $table) {
            //
        });
    }
};

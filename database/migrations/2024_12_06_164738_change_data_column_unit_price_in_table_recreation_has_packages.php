<?php

use App\Models\RecreationPackages;
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
        Schema::table('recreation_has_packages', function (Blueprint $table) {
            //
        });

        $datas = RecreationPackages::all();

        foreach ($datas as $key => $d) {
            $d['unit_price'] = $d['price'] + 10000;
            $d->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recreation_has_packages', function (Blueprint $table) {
            //
        });
    }
};

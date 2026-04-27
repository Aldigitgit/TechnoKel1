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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('jenis_produk', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            // Reverting back might lose data that isn't in the original enum, 
            // but we'll try our best.
            $table->enum('jenis_produk', [
                'Bakpao Manis', 
                'Bakpao Gurih', 
                'Bakpao Spesial', 
                'Dimsum Goreng'
            ])->nullable()->change();
        });
    }
};

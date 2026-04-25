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
        Schema::create('Mitra', function (Blueprint $table) {
            $table->increments('Mitra_Id');
            $table->string('Nama_Mitra', 200);
            $table->text('Alamat');
            $table->string('Email', 50);
            $table->string('Nomor_Telepon', 20);
            $table->enum('Kemitraan', ['Platinum', 'Gold', 'Silver']);
            $table->date('Bergabung');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Mitra');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->increments('mitra_id');
            $table->string('nama_mitra', 200);
            $table->text('alamat');
            $table->string('email', 100)->unique();
            $table->string('nomor_telepon', 20);
            $table->enum('kemitraan', ['Platinum', 'Gold', 'Silver']);
            $table->date('bergabung');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};
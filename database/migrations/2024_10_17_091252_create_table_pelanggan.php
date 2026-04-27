<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hanya gunakan satu migrasi untuk tabel pelanggan
        if (!Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->increments('pelanggan_id');
                $table->string('first_name', 100);
                $table->string('last_name', 100);
                $table->date('birthday')->nullable();
                $table->enum('gender', ['Male', 'Female'])->nullable();
                $table->string('email')->unique();
                $table->string('phone', 20)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
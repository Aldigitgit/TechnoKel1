<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('produk_id');
            $table->string('nama_produk', 100)->unique();
            $table->integer('jumlah')->default(0);
            $table->enum('kategori', [
                'Bakpao Manis', 
                'Bakpao Gurih', 
                'Bakpao Spesial', 
                'Dimsum Goreng'
            ]);
            $table->integer('harga')->default(0);
            $table->date('tgl_masuk');
            $table->date('tgl_expired');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
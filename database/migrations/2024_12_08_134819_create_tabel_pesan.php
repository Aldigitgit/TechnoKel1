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
        Schema::create('Pesan', function (Blueprint $table) {
            $table->increments('pesan_id');
            // Detail Pemesanan
            $table->string('jenis_kue');
            $table->string('ukuran_kue');
            $table->string('rasa_kue');
            $table->string('pesan_kue')->nullable();
            $table->timestamp('tanggal_pengambilan');
            $table->string('tema_kue')->nullable();

            // Detail Pengiriman
            $table->string('alamat_pengiriman')->nullable();
            $table->string('nama_penerima')->nullable();
            $table->string('kontak_penerima')->nullable();

            // Detail Pemesan
            $table->string('nama_pemesan');
            $table->string('kontak_pemesan');
            $table->string('email_pemesan');

            // Detail Pembayaran
            $table->decimal('nominal_dp', 10, 2)->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();

            // Catatan Tambahan
            $table->text('instruksi_khusus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pesan');
    }
};

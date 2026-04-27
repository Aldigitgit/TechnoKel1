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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('pesanan_id');
            $table->timestamps();
            
            // ========== 1. Detail Pemesanan ==========
            $table->enum('jenis_produk', [
                'Bakpao Manis', 
                'Bakpao Gurih', 
                'Bakpao Spesial', 
                'Dimsum Goreng'
            ])->nullable();
            
            $table->string('varian_produk', 100)->nullable();
            $table->integer('jumlah_pesanan')->default(1);
            $table->dateTime('tanggal_pengambilan');
            $table->text('catatan_pesanan')->nullable();
            
            // ========== 2. Detail Pengiriman ==========
            $table->boolean('ambil_di_toko')->default(false);
            $table->text('alamat_pengiriman')->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->string('kontak_penerima', 20)->nullable();
            
            // ========== 3. Detail Pemesan ==========
            $table->string('nama_pemesan', 100);
            $table->string('kontak_pemesan', 20);
            $table->string('email_pemesan', 100)->nullable();
            
            // ========== 4. Status Pemesanan ==========
            $table->enum('status', [
                'pending',      // Menunggu konfirmasi
                'confirmed',    // Sudah dikonfirmasi
                'processing',   // Sedang diproses
                'ready',        // Siap diambil/dikirim
                'completed',    // Selesai
                'cancelled'     // Dibatalkan
            ])->default('pending');
            
            // ========== 5. Informasi Tambahan ==========
            $table->text('instruksi_khusus')->nullable();
            $table->decimal('total_harga', 12, 2)->nullable();
            $table->decimal('dp_dibayar', 12, 2)->nullable();
            $table->enum('metode_pembayaran', ['transfer', 'ewallet', 'cash', 'cod'])->nullable();
            $table->string('bukti_pembayaran')->nullable();
            
            // Catatan admin
            $table->text('catatan_admin')->nullable();
            
            // Waktu konfirmasi & penyelesaian
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            
            // Index untuk pencarian
            $table->index('status');
            $table->index('tanggal_pengambilan');
            $table->index('nama_pemesan');
            $table->index('kontak_pemesan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
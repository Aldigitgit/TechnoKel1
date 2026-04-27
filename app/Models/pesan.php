<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'pesanan_id';

    protected $fillable = [
        // Detail Pemesanan
        'jenis_produk',
        'varian_produk',
        'jumlah_pesanan',
        'tanggal_pengambilan',
        'catatan_pesanan',

        // Detail Pengiriman
        'ambil_di_toko',
        'alamat_pengiriman',
        'nama_penerima',
        'kontak_penerima',

        // Detail Pemesan
        'nama_pemesan',
        'kontak_pemesan',
        'email_pemesan',

        // Status
        'status',

        // Informasi Tambahan
        'instruksi_khusus',
        'total_harga',
        'dp_dibayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'catatan_admin',
        'confirmed_at',
        'completed_at',
    ];

    protected $casts = [
        'tanggal_pengambilan' => 'datetime',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'ambil_di_toko' => 'boolean',
        'jumlah_pesanan' => 'integer',
        'total_harga' => 'decimal:2',
        'dp_dibayar' => 'decimal:2',
    ];
}
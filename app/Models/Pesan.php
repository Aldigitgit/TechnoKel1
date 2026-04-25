<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    use HasFactory;
    protected $primaryKey = 'pesan_id';
    protected $table = 'Pesan';

    protected $fillable = [
        // Detail Pemesanan
        'jenis_kue',
        'ukuran_kue',
        'rasa_kue',
        'pesan_kue',
        'tanggal_pengambilan',
        'tema_kue',

        // Detail Pengiriman
        'alamat_pengiriman',
        'nama_penerima',
        'kontak_penerima',

        // Detail Pemesan
        'nama_pemesan',
        'kontak_pemesan',
        'email_pemesan',

        // Detail Pembayaran
        'nominal_dp',
        'metode_pembayaran',
        'bukti_pembayaran',

        // Catatan Tambahan
        'instruksi_khusus',
    ];
}

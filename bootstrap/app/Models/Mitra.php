<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'mitra_Id';
    protected $table = 'mitra';

    protected $fillable = [
        'mitra_Id',
        'Nama_mitra',
        'Alamat',
        'Email',
        'Nomor_Telepon',
        'Kemitraan',
        'Bergabung'
    ];
}

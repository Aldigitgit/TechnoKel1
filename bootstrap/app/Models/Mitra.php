<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'Mitra_Id';
    protected $table ='Mitra';

    protected $fillable =[
        'Mitra_Id',
        'Nama_Mitra',
        'Alamat',
        'Email',
        'Nomor_Telepon',
        'Kemitraan',
        'Bergabung'
    ];
}

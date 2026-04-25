<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
    {
        // Filter kolom berdasarkan input
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'Bergabung') {
                    // Filter tahun dari kolom Bergabung
                    $query->whereYear('Bergabung', $request->input($column));
                } else {
                    // Filter kolom lain
                    $query->where($column, $request->input($column));
                }
            }
        }
    
        // Pencarian global
        if ($request->filled('search') && !empty($searchableColumns)) {
            $query->where(function ($q) use ($request, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->input('search') . '%');
                }
            });
        }
    
        return $query;
    }
    
    
}

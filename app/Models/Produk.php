<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'produk_id';
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'jumlah',
        'kategori',
        'harga',
        'tgl_masuk',
        'tgl_expired',
    ];

    protected $casts = [
        'tgl_masuk' => 'date',
        'tgl_expired' => 'date',
        'jumlah' => 'integer',
        'harga' => 'integer',
    ];

    // Accessor untuk status stok
    public function getStatusStokAttribute()
    {
        if ($this->jumlah <= 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->jumlah <= 10) {
            return '<span class="badge bg-warning text-dark">Stok Terbatas</span>';
        } else {
            return '<span class="badge bg-success">Tersedia</span>';
        }
    }

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

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
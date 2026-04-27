<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Mitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'mitra_id';
    protected $table = 'mitra';

    protected $fillable = [
        'nama_mitra',
        'alamat',
        'email',
        'nomor_telepon',
        'kemitraan',
        'bergabung',
    ];

    protected $casts = [
        'bergabung' => 'date',
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'bergabung') {
                    $query->whereYear('bergabung', $request->input($column));
                } else {
                    $query->where($column, $request->input($column));
                }
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
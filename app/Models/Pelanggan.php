<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pelanggan_id';
    protected $table ='pelanggan';

    protected $fillable =[
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone'
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
    {
        // Filter kolom berdasarkan input
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'birthday') {
                    // Filter tahun dari kolom birthday
                    $query->whereYear('birthday', $request->input($column));
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

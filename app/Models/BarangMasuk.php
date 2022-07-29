<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';

    protected $fillable = [
        'id_supplier',
        'total_harga',
        'tanggal'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }

    public function barang_masuk_detail(){
        return $this->hasMany(BarangMasukDetail::class, 'id_barang_masuk', 'id');
    }
}

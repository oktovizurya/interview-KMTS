<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDetail extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_detail';

    protected $fillable = [
        'id_barang_masuk',
        'id_barang',
        'jumlah',
        'total'
    ];

    public function barang_masuk(){
        return $this->belongsTo(BarangMasuk::class, 'id_barang_masuk', 'id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}

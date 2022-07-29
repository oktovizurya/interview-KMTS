<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_detail';

    protected $fillable = [
        'id_barang_keluar',
        'id_barang',
        'jumlah',
        'total'
    ];

    public function barang_keluar(){
        return $this->belongsTo(BarangKeluar::class, 'id_barang_keluar', 'id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}

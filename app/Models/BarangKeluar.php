<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';

    protected $fillable = [
        'id_pelanggan',
        'total_harga',
        'tanggal'
    ];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function barang_keluar_detail(){
        return $this->hasMany(BarangKeluarDetail::class, 'id_barang_keluar', 'id');
    }
}

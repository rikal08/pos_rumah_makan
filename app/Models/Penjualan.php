<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'no_transaksi',
        'id_pelanggan',
        'total_item',
        'total_harga',
        'bayar',
        'kembali',
        'id_user',
    ];
}

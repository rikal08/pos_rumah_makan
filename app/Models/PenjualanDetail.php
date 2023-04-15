<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_detail';

    protected $primaryKey = 'id_penjualan_detail';

    protected $fillable = [
        'no_transaksi',
        'id_produk',
        'harga_jual',
        'jumlah',
        'diskon',
        'subtotal',
    ];
}

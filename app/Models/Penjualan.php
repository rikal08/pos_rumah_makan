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
        'id_member',
        'total_item',
        'total_harga',
        'diskon',
        'bayar',
        'kembali',
        'id_user',
        'created_at'
    ];
}

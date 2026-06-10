<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'nama_pemesan',
        'nomor_wa',
        'email',
        'nama_produk',
        'jumlah',
        'status',
    ];
}

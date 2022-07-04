<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtcAddress extends Model
{
    use HasFactory;

    protected $table = "btc_address";
    protected $fillable = [
        'id',
        'btc_address',
        'eth_address',
        'usdt_address',
    ];
}

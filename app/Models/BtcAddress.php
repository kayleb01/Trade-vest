<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtcAddress extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'wallet_address'];
}

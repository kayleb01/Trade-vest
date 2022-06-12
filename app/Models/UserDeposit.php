<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    use HasFactory;

    protected $table = 'user_deposits';

    protected $fillable = ['user_id', 'total', 'compounded', 'locked', 'top_up'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

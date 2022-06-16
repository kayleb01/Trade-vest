<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransactions extends Model
{
    use HasFactory;

    protected $table = 'user_transactions';
    protected $with = ['contract', 'user'];
    protected $fillable = ['user_id', 'contract_id', 'proof', 'amount', 'status', 'type'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->proof != null) {
            return url('storage/media/proof/'.$this->created_at->format('Y').'/'.$this->created_at->format('m').'/' . $this->proof);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

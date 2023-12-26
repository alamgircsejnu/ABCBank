<?php

namespace App\Models\Accounts;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'currency_code',
    ];

    public function transactions(): HasMany
    {
       return $this->hasMany(Transaction::class);
    }
}

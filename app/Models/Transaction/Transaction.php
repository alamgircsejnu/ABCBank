<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'amount',
        'type',
        'details',
        'balance',
    ];

    public function format(): array
    {
        return [
            'datetime' => $this->created_at->format('d-m-Y H:i:s A'),
            'amount' => $this->amount,
            'type' => $this->type,
            'remarks' => $this->details,
            'balance' => $this->balance,
        ];
    }
}

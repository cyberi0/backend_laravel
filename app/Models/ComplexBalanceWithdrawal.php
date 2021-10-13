<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexBalanceWithdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        "complex_id",
        "account_id",
        "amount",
        "receipt",
        "withdrawn_at",
        "withdrawn_by",
    ];

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}

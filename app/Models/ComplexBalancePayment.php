<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexBalancePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "withdrawal_id",
        "payment_id"
    ];


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }


    public function withdrawal()
    {
        return $this->belongsTo(ComplexBalanceWithdrawal::class, 'withdrawal_id', 'id');
    }


}

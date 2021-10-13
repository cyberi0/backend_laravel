<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalanceTransaction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "balance_id",
        "payment_id",
        "type",
        "amount"
    ];
    public function balance()
    {
        return $this->belongsTo(UserBalance::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }


}

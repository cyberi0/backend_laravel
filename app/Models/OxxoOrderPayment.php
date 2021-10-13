<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OxxoOrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "payment_id"
    ];

    public function order()
    {
        return $this->belongsTo(OxxoOrder::class, 'order_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OxxoOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "amount",
        "fee",
        "order_id",
        "charge_id",
        "bardcode",
        "reference",
        "expired_at",
        "paid_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }


}

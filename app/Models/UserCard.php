<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "provider_id",
        "brand",
        "digits",
        "bank",
        "data"
    ];

    public function provider() {
        return $this->belongsTo(PaymentProvider::class, 'provider_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

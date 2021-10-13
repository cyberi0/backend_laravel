<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMercadopagoCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "user_card_id",
        "card_id"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

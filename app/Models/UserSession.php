<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "token",
        "uuid",
        "platform",
        "ip",
        "device",
        "expired_at"
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

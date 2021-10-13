<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMercadopago extends Model
{
    use HasFactory;

    protected $table = "user_mercadopago";

    protected $fillable = [
        "user_id" ,
        "customer_id",
        "email",
        "first_name",
        "last_name",
        "description"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }


}

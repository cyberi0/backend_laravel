<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexControl extends Model
{
    use HasFactory;
    protected $table = "complex_control";
    protected $fillable = [
        "complex_id" ,
        "url",
        "api_uuid",
        "api_key",
        "pi_id",
        "pi_access_token" ,
        "last_ping"
    ];

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id', 'id');
    }
}

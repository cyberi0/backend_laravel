<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "method_id", "complex_id", "bank_id",
        "owner", "number", "card", "clabe"
    ];

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        "method_id", "provider_id", "bank_id",
        "owner", "number", "card", "clabe"
    ];

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

    public function provider()
    {
        return $this->belongsTo(ComplexProvider::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}

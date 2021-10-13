<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexBalanceConfig extends Model
{
    use HasFactory;
    protected $table = "complex_balance_config";

    protected $fillable = [
        "complex_id",
        "percentage",
        "fixed",
        "client"
    ];

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id', 'id');
    }
}

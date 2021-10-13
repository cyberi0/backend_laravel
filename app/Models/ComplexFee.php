<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexFee extends Model
{
    use HasFactory;

    protected $fillable = [
        "complex_id",
        "type_id",
        "amount",
        "cutoff",
        "limit"
    ];

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id', 'id');
    }

    public function complex_fee_type()
    {
        return $this->belongsTo(ComplexFeeType::class, 'type_id', 'id');
    }
}

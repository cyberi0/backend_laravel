<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexBalanceAccount extends Model
{

    protected $fillable = [
      "complex_id",
      "bank_id",
      "owner",
      "interbank",
      "number",
      "branch",
      "card",
    ];
    use HasFactory;


    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}

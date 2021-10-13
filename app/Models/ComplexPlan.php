<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexPlan extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complex_id','plan_id', 'last_payment_at', 'next_payment_at'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }
}

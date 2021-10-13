<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgreementPayment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agreement_id', 'payment_id'
    ];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}

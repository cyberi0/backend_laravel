<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Property;

class Agreement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'complex_id', 'created_by', 'owner_id', 'occupant_id',
        'property_id', 'name', 'description','amount', 'total'
    ];

    public function payments()
    {
        return $this->hasMany(AgreementPayment::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function occupant()
    {
        return $this->belongsTo(User::class, 'occupant_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class, 'property_id', 'id');
    }

}

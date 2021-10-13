<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "complex_id",
        "type_id",
        "owner_id",
        "occupant_id",
        "name",
        "floor",
        "number",
        "contract",
        "contract_expired_at",
        "proportions",
        "document",
        "book"
    ];

    function complex() {
        return $this->belongsTo(Complex::class,'complex_id', 'id');
    }

    function property_type() {
        return $this->belongsTo(PropertyType::class,'type_id', 'id');
    }

    function owner() {
        return $this->belongsTo(User::class,'owner_id', 'id');
    }
    function occupant() {
        return $this->belongsTo(User::class,'occupant_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        "complex_id",
        "property_id",
        "type_id",
        "brand",
        "model",
        "plate",
        "color",
        "photo",
        "year"
    ];

    public function complex() {
        return $this->belongsTo(Complex::class, 'complex_id','id');
    }

    public function property() {
        return $this->belongsTo(Property::class, 'property_id','id');
    }

    public function type() {
        return $this->belongsTo(VehicleType::class, 'type_id','id');
    }
}

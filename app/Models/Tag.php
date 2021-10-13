<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        "type_id",
        "vehicle_id",
        "complex_id",
        "property_id",
        "identifier",
        "number",
        "status_id"
    ];

    public function tag_type() {
        return $this->belongsTo(TagType::class,'type_id', 'id');
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class,'vehicle_id', 'id');

    }

    public function complex() {
        return $this->belongsTo(Complex::class,'complex_id', 'id');

    }

    public function property() {
        return $this->belongsTo(Property::class,'property_id', 'id');

    }

    public function tag_status() {
        return $this->belongsTo(TagStatus::class,'status_id', 'id');

    }
}

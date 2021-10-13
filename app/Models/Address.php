<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "complex_id",
        "property_id",
        "street",
        "house_number",
        "settlement",
        "postal_code",
        "locality",
        "town",
        "state",
        "country",
        "latitude",
        "longitude",
    ];


    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }


}

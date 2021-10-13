<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexAdministration extends Model
{
    use HasFactory;

    protected $fillable = [
        "complex_id",
        "type_id"
    ];

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function administration_type()
    {
        return $this->belongsTo(ComplexAdministrationType::class, 'type_id', 'id');
    }
}

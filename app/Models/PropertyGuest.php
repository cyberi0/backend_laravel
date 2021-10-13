<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        "guest_id",
        "property_id",
        "created_by"
    ];

    public function guest() {
        return $this->hasOne(Guest::class, 'id','guest_id');
    }

    public function property() {
        return $this->hasOne(Property::class, 'id','property_id');
    }

    public function created_by() {
        return $this->hasOne(User::class, 'id','created_by');
    }


}

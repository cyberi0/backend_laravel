<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestAccessControl extends Model
{
    use HasFactory;

    protected $table = "guest_access_control";

    protected $fillable = [
        "property_guest_id",
        "conceded_type_id",
        "conceded_by",
        "access_at",
        "created_by"
    ];

    public function property_guest() {
        return $this->hasOne(PropertyGuest::class, 'id','property_guest_id');
    }

    public function conceded_type() {
        return $this->hasOne(GuestAccessControlConcededType::class, 'id','conceded_type_id');
    }

    public function conceded_by() {
        return $this->hasOne(User::class, 'id','conceded_by');
    }
}

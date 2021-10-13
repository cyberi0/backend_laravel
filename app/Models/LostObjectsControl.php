<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostObjectsControl extends Model
{
    use HasFactory;

    protected $table = "lost_objects_control";

    protected $fillable = [
        "property_id",
        "common_area_id",
        "reported_by_user",
        "reported_by_guest",
        "reported_at",
        "finded_by_user",
        "finded_by_guest",
        "finded_at",
        "comments",
        "lost_at",
        "created_by"
    ];

    public function reported_by_user() {
        return $this->belongsTo(User::class, 'reported_by_user');
    }

    public function reported_by_guest() {
        return $this->belongsTo(Guest::class, 'reported_by_guest');
    }

    public function finded_by_user() {
        return $this->belongsTo(User::class, 'finded_by_user');
    }

    public function finded_by_guest() {
        return $this->belongsTo(Guest::class, 'finded_by_guest');
    }

    public function created_by() {
        return $this->hasOne(User::class, 'created_by','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestAccessControlDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        "guest_id",
        "type_id",
        "identification",
        "created_by"
    ];

    public function guest() {
        return $this->hasOne(Guest::class, 'id','guest_id');
    }

    public function document_type() {
        return $this->hasOne(GuestAccessControlDocumentType::class, 'id','type_id');
    }

    public function created_by() {
        return $this->hasOne(User::class, 'id','created_by');
    }
}

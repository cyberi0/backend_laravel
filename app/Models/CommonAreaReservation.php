<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonAreaReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "common_area_id",
        "property_id",
        "payment_id",
        "starts_at",
        "ends_at",
        "amount",
    ];

    public function common_area()
    {
        return $this->belongsTo(CommonArea::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

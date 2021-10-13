<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsViews extends Model
{
    use HasFactory;

    protected $fillable = [
        "news_id",
        "property_id",
        "owner_id",
        "occupant_id",
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }

    public function property() {
        return $this->belongsTo(News::class, 'property_id', 'id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function occupant() {
        return $this->belongsTo(User::class, 'occupant_id', 'id');
    }


}

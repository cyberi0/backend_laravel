<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'occupant_id',
        'type',
        'name',
        'description',
        'periodicity',
        'day',
        'time'
    ];

    public function occupant() {
        return $this->hasOne(User::class,'id', 'occupant_id');
    }
}

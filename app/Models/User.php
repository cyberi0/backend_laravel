<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id",
        "type_id",
        "created_by",
        "names",
        "surnames",
        "username",
        "password",
        "email",
        "mobile",
        "curp",
        "email_verified_at"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function created_by() {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function user_type() {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasFactory;

    protected $table = "complexes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "owner_id",
        "admin_id",
        "created_by",
        "type_id",
        "use_id",
        "name"
    ];

    public function plan() {
        return $this->hasOne(ComplexPlan::class);
    }

    public function owner() {
        return $this->hasOne(User::class,"id", "owner_id");
    }

    public function admin() {
        return $this->hasOne(User::class,"id", "admin_id");
    }

    public function createdBy() {
        return $this->hasOne(User::class,"id", "created_by");
    }

    public function typeComplex() {
        return $this->hasOne(ComplexType::class,"id", "type_id");
    }



}

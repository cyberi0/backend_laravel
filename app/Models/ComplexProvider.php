<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "company",
        "contact_names",
        "contact_surnames",
        "email" ,
        "phone",
        "mobile" ,
    ];
    public function category()
    {
        return $this->belongsTo(ComplexProviderCategory::class, 'category_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderTaxData extends Model
{
    use HasFactory;

    protected $table = "provider_tax_data";

    protected $fillable = [
        "provider_id", "rfc", "name",
        "address", "postal_code"
    ];

    public function provider()
    {
        return $this->belongsTo(ComplexProvider::class);
    }


}

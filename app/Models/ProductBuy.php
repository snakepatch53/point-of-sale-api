<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    use HasFactory;

    protected $fillable = [
        "tax",
        "suplier_id",
        "user_id"
    ];

    public function supplier()
    {
        return $this->belongsTo(Suplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productIns()
    {
        return $this->hasMany(ProductIn::class);
    }
}

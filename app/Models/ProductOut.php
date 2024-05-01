<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;

    protected $fillable = [
        "quantity",
        "price",
        "commission",
        "product_id",
        "product_sale_id",
    ];

    public function productSale()
    {
        return $this->belongsTo(ProductSale::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

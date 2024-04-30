<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIn extends Model
{
    use HasFactory;

    protected $fillable = [
        "date",
        "quantity",
        "price",
        "commission",
        "product_id",
        "product_buy_id",
    ];

    public function productBuy()
    {
        return $this->belongsTo(ProductBuy::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

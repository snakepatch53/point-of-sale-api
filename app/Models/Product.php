<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "mark",
        "model",
        "elaboration",
        "expiration",
        "description",
        "photo",
        "locker_id",
    ];

    protected $appends = ["photo_url", "stock", "price"];

    public function getPhotoUrlAttribute()
    {
        if ($this->photo == null) return asset("storage/app/public/img/product.png");
        return asset("storage/app/public/img_products/" . $this->photo);
    }

    public function getStockAttribute()
    {
        $stock = 0;
        foreach ($this->productIns as $productIn) {
            $stock += $productIn->quantity;
        }
        foreach ($this->productOuts as $productOut) {
            $stock -= $productOut->quantity;
        }
        return $stock > 0 ? $stock : 0;
    }

    public function getPriceAttribute()
    {
        $price = 0;
        foreach ($this->productIns as $productIn) {
            $price += $productIn->price;
        }
        foreach ($this->productOuts as $productOut) {
            $price -= $productOut->price;
        }
        return $price > 0 ? $price : 0;
    }

    public function loker()
    {
        return $this->belongsTo(Locker::class);
    }

    public function productIns()
    {
        return $this->hasMany(ProductIn::class);
    }

    public function productOuts()
    {
        return $this->hasMany(ProductOut::class);
    }
}

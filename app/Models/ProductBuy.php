<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        "total",
        "date_str"
    ];

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->productIns as $productIn) {
            $total += $productIn->quantity * $productIn->price;
        }
        return $total;
    }

    public function getDateStrAttribute()
    {
        return Carbon::parse($this->created_at)->locale('es_ES')->isoFormat('dddd, D [de] MMMM [del] YYYY');
    }

    public function suplier()
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

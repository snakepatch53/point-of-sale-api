<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        "tax",
        "client_id",
        "user_id",
    ];

    protected $appends = [
        "total",
        "date_str"
    ];

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->productOuts as $productOut) {
            $total += $productOut->quantity * $productOut->price;
        }
        return $total;
    }

    public function getDateStrAttribute()
    {
        return Carbon::parse($this->created_at)->locale('es_ES')->isoFormat('dddd, D [de] MMMM [del] YYYY');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productOuts()
    {
        return $this->hasMany(ProductOut::class);
    }
}

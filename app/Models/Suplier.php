<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "province",
        "city",
        "address",
        "phone",
        "cellphone",
        "email",
        "ruc",
        "entiy_id"
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function productBuys()
    {
        return $this->hasMany(ProductBuy::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}

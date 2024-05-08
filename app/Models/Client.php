<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "name2",
        "lastname",
        "lastname2",
        "dni",
        "ruc",
        "city",
        "address",
        "phone",
        "cellphone",
        "email",
        "entity_id"
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function productSales()
    {
        return $this->hasMany(ProductSale::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}

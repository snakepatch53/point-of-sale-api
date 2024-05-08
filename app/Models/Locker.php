<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "entity_id"
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}

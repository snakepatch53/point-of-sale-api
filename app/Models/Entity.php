<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "logo",
        "icon",
        "city",
        "address",
        "phone",
        "cellphone",
        "email",
        "tax",
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["logo_url", "icon_url"];

    public function getLogoUrlAttribute()
    {
        if ($this->logo == null) return asset("storage/app/public/img/logo.png");
        return asset("storage/app/public/entity_logo/" . $this->logo);
    }

    public function getIconUrlAttribute()
    {
        if ($this->logo == null) return asset("storage/app/public/img/icon.png");
        return asset("storage/app/public/entity_icon/" . $this->icon);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function supliers()
    {
        return $this->hasMany(Suplier::class);
    }

    public function lockers()
    {
        return $this->hasMany(Locker::class);
    }
}

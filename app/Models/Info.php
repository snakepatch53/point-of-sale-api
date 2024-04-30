<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
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

    protected $append = ["logo_url", "icon_url"];

    public function getLogoUrlAttribute()
    {
        if ($this->logo == null) return asset("storage/app/public/img/logo.png");
        return asset("storage/app/public/info_logo/" . $this->logo);
    }

    public function getIconUrlAttribute()
    {
        if ($this->logo == null) return asset("storage/app/public/img/icon.png");
        return asset("storage/app/public/info_icon/" . $this->icon);
    }
}

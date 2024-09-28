<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company_name', 'description', 'address', 'contact'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Menu (One-to-Many)
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    // public function merchant()
    // {
    //     return $this->belongsTo(Merchant::class);
    // }
}

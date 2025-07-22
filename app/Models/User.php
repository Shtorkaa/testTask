<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        "phone",
        "adress",
        "name",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

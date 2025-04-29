<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'categoryName',
        'categoryImg',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

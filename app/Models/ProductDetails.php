<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $fillable = [
        'img1',
        'img2',
        'img2',
        'color',
        'size',
        'des',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

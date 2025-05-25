<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $fillable = [
        'title',
        'description',
        'price',
        'discount_price',
        'image',
        'stock_quantity',
        'status',
        'remark',
        'category_id',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    public function productDetails()
    {
        return $this->hasMany(ProductDetails::class);
    }

    // public function productcarts()
    // {
    //     return $this->hasMany(ProductCart::class);
    // }

    public function productreviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}

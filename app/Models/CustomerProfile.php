<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productreviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CustomerProfile extends Model
{
    // protected $fillable = [
    //     'user_id',
    //     'first_name',
    //     'last_name',
    //     'phone_number',
    //     'address',
    //     'city',
    //     'state',
    //     'country',
    //     'zip_code',
    // ];

            protected $fillable = [
            'user_id', // Important: user_id is also mass assignable
            'cus_name',
            'cus_add',
            'cus_city',
            'cus_state',
            'cus_postcode',
            'cus_country',
            'cus_phone',
            'cus_fax',
            'ship_name',
            'ship_add',
            'ship_city',
            'ship_state',
            'ship_postcode',
            'ship_country',
            'ship_phone',
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

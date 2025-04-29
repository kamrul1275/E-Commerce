<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'otp',
    ];

    protected $attributes = [

            'otp' => '0',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // //relation with brands
    // public function brands()
    // {
    //     return $this->hasMany(Brand::class);
    // }
    // //relation with categories
    // public function categories()
    // {
    //     return $this->hasMany(Category::class);
    // }
    // //relation with products
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    // relation with CustomerProfile
    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class);
    }


}

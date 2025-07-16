<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'website',
        'street',
        'suite',
        'city',
        'zipcode',
        'geo_lat',
        'geo_lng',
        'company_name',
        'company_catch_phrase',
        'company_bs',
        'password'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }


}

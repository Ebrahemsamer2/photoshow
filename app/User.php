<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image() {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function videos() {
        return $this->hasMany('App\Video');
    }

    public function photos() {
        return $this->hasMany('App\Photo');
    }

    public function albums() {
        return $this->hasMany('App\Album');
    }
}

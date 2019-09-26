<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Photo extends Model
{
    protected $fillable = [
    	'name',
    	'filename',
    	'user_id',
    	'album_id',
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function album() {
    	return $this->belongsTo('App\Album');
    }
}

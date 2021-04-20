<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

	protected $fillable = [
        'name', 'description',
    ];

    public function owner()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function products()
    {
    	return $this->hasMany('App\Product','shop_id');
    }

}

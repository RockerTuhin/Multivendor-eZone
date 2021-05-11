<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $casts = [
    //     'product_attributes' => 'array',
    // ];
    public function shop()
    {
    	return $this->belongsTo('App\Shop','shop_id');
    }

    protected static function booted()
    {
        static::saving(function ($product) {
            $product->product_attributes = json_encode(request('product_attributes'));
            //$product->product_attributes = request('product_attributes');
        });
    }
}

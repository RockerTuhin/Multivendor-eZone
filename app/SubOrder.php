<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Product::class,'sub_order_items','sub_order_id','product_id')->withPivot('price', 'quantity');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

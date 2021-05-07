<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_id','amount_paid','commission','status'];

    public function subOrder()
    {
        return $this->belongsTo(SubOrder::class);
    }
}

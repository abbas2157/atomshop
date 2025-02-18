<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id','id');
    }
}

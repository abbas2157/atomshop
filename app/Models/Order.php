<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id','id')->select('id', 'product_id', 'product_price', 'product_advance_price', 'tenure', 'color_id', 'memory_id', 'size_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name','phone');
    }
}

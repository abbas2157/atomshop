<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderInstalment extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function scopeWithOrderDetails(Builder $query)
    {
        return $query->with('order.cart.product:id,title');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    public function cart()
    {
        return $this->belongsTo(CustomOrderProduct::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'phone');
    }
    public function CustomOrderProduct()
    {
        return $this->belongsTo(CustomOrderProduct::class, 'product_id', 'id')
            ->select('id', 'title', 'pr_number', 'category_id', 'brand_id','picture');
    }
    public function product()
    {
        return $this->belongsTo(CustomOrderProduct::class, 'product_id', 'id')
            ->select('id', 'title', 'pr_number', 'category_id', 'brand_id','picture');
    }
}

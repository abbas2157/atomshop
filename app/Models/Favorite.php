<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'guest_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'phone');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->select('id', 'pr_number', 'title', 'slug', 'price', 'min_advance_price', 'picture', 'category_id', 'brand_id');
    }
}

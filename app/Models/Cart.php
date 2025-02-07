<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $casts = [
        'quantity' => 'integer',
        'status' => 'string',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id')->select('id', 'title', 'price', 'picture');
    }

}


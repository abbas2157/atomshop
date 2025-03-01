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
        return $this->belongsTo(Product::class, 'product_id')->select('id', 'min_advance_price', 'pr_number', 'title', 'price', 'picture');
    }
    public function color()
    {
        return $this->hasOneThrough(Color::class,ProductColor::class,'product_id','id','product_id','color_id');
    }
    public function memory()
    {
        return $this->hasOneThrough(Memory::class,ProductMemory::class,'product_id','id','product_id','memory_id');
    }
}

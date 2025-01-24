<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['product_picture'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->select('id','title');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id')->select('id','title');
    }
    public function description()
    {
        return $this->hasOne(ProductDescription::class,'id','product_id')->select('id','title');
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class,'id','product_id')->select('id','title');
    }
    public function memories()
    {
        return $this->hasMany(ProductMemory::class,'id','product_id')->select('id','title');
    }
    public function getProductPictureAttribute() {
        return asset($this->picture);
    }
    public function getFormattedPriceAttribute()
{
    return number_format($this->price, 0);
}
}

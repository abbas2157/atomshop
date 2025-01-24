<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['product_picture', 'formatted_price'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->select('id','title','picture');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id')->select('id','title','picture');
    }
    public function description()
    {
        return $this->hasOne(ProductDescription::class,'id','product_id')->select('id','title');
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class,'product_id','id')->with('color');
    }
    public function memories()
    {
        return $this->hasMany(ProductMemory::class,'product_id','id')->with('memory');
    }
    public function getProductPictureAttribute() {
        return asset($this->picture);
    }
    public function getFormattedPriceAttribute()
{
    return number_format($this->price, 0);
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['product_picture', 'formatted_price'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id', 'title', 'slug', 'picture');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->select('id', 'title', 'slug', 'picture');
    }
    public function description()
    {
        return $this->hasOne(ProductDescription::class,'product_id','id')->select('id','product_id','short','long');
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id')->with('color');
    }
    public function memories()
    {
        return $this->hasMany(ProductMemory::class, 'product_id', 'id')->with('memory');
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id')->with('size');
    }
    public function gallery()
    {
        return $this->hasMany(ProductImage::class,'product_id','id')->select('id','url','product_id');
    }
    public function getProductPictureAttribute() {
        return asset($this->picture);
    }
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0);
    }
    public function getFormattedAdvancePriceAttribute()
    {
        return number_format($this->min_advance_price, 0);
    }
}

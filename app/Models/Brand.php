<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
    protected $appends = ['brand_picture'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->select('id','title');
    }
    public function getBrandPictureAttribute() {
        return asset($this->picture);
    }
}

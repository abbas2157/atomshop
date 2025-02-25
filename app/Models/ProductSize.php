<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    public $timestamps = false;
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0);
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','id')->select('id','title');
    }
}

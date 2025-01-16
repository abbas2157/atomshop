<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->select('id','title');
    }
}

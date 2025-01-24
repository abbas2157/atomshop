<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    public $timestamps = false;
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id','id')->select('id','title');
    }
    
}

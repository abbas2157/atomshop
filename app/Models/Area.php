<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function cities()
    {
        return $this->belongsTo(City::class,'city_id','id')->select('id','title');
    }
    
    public function activeSellers()
    {
        return $this->hasMany(ActiveSeller::class, 'area_id');
    }

}

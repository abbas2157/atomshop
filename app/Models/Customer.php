<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name','phone');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id')->select('id','title');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'area_id','id')->select('id','title');
    }
}

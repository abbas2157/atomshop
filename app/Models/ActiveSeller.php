<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveSeller extends Model
{
    protected $fillable = [
        'user_id',  
        'area_id', 
        'seller_id', 
        'status',
    ];
}

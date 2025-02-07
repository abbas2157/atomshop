<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMemory extends Model
{
    public $timestamps = false;
    public function memory()
    {
        return $this->belongsTo(Memory::class,'memory_id','id')->select('id','title');
    }
}

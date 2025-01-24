<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getPictureAttribute() {
        return public_path($this->picture);
    }
}

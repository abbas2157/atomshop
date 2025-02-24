<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    
}

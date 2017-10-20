<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function orders()
    {
    	return $this->hasMany(Order::class);
    }

    public function types()
    {
    	return $this->hasMany(AvailableBatchType::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentAddress extends Model
{
    protected $fillable = [
        'address', 'tracking_number', 'recipient_id',
    ];
}

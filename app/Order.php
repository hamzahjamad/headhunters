<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $appends = ['total_price', 'name'];

    public function recipient()
    {
    	return $this->belongsTo(Recipient::class);
    }

    public function shipmentAddress()
    {
    	return $this->belongsTo(ShipmentAddress::class);
    }


    public function sleeveType()
    {
    	return $this->belongsTo(SleeveType::class);
    }


    public function color()
    {
    	return $this->belongsTo(Color::class);
    }

    public function getNameAttribute()
    {
    	return ucwords($this->color->name . ' ' . $this->sleeveType->name);
    }

    public function getTotalPriceAttribute()
    {
    	$sizes = [
    		'xs',
    		's',
    		'm',
    		'l',
    		'xl',
    		'xxl',
    		'xxxl',
    	];

    	$count = 0;

    	foreach ($sizes as $size) {
    		$count += $this->{$size};
    	}

    	$price = $this->price_per_item ? $this->price_per_item : 0; 

    	return $count*$price;
    }
}

<?php

use Faker\Generator as Faker;

$factory->define(App\ShipmentAddress::class, function (Faker $faker) {
	static $recipient_id;
    return [
    	'address' => $faker->address,
    	'recipient_id' => $recipient_id ?: $recipient_id = \App\User::first()->id,
        //'tracking_number' => 'EP400379045MY',
    ];
});

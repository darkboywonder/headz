<?php

use App\Barbershop;
use Faker\Generator as Faker;

$factory->define(Barbershop::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'url' => 'http://' . $faker->domainName,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postCode,
        'latitude' => $faker->latitude(24.39, 49.38),
        'longitude' => $faker->longitude(-124.8, -66.9),
    ];
});

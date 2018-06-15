<?php

use App\Barber;
use App\User;
use Faker\Generator as Faker;

$factory->define(Barber::class, function () {
    return [ 'is_barber' => true ] + factory(User::class)->raw();
});

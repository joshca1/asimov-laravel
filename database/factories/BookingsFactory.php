<?php

use Faker\Generator as Faker;

$factory->define(App\Booking::class, function (Faker $faker) {
    return [
        'booking_date' => $faker->date,
        'booking_hour' => $faker->numberBetween(9, 17),
        'email' => $faker->unique()->safeEmail,
    ];
});

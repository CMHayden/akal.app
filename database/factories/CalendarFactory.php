<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calendar;
use Faker\Generator as Faker;

$factory->define(Calendar::class, function (Faker $faker) {
    return [
        'event_name'    => $faker->name,
        'start_date'    => '2020-04-01',
        'end_date'      => '2020-04-01',
        'patient_email' => $faker->safeEmail
    ];
});

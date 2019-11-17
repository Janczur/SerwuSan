<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Billing;
use App\BillingData;
use Faker\Generator as Faker;

$factory->define(BillingData::class, function (Faker $faker) {
    return [
        'call_start_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        'call_duration' => $this->faker->numberBetween(10, 700),
    ];
});

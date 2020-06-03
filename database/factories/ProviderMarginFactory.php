<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProvidersMargin;
use Faker\Generator as Faker;

$factory->define(ProvidersMargin::class, function (Faker $faker) {
    return [
        'country' => $this->faker->sentence(2),
        'margin' => $this->faker->randomFloat(4, 0, 1),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Billing;
use App\BillingData;
use App\User;
use Faker\Generator as Faker;

$factory->define(Billing::class, function (Faker $faker) {
    return [
        'name' => $this->faker->sentence(4),
        'working_days_rate' => $this->faker->randomFloat(4, 0, 1),
        'weekend_rate' => $this->faker->randomFloat(4, 0, 1),
        'owner_id' => function (){
            return factory(User::class)->create()->id;
        }
    ];
});

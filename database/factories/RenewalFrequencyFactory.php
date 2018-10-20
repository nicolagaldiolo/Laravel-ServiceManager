<?php

use Faker\Generator as Faker;
use App\Enums\RenewalFrequencies;

$factory->define(App\RenewalFrequency::class, function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(1,4),
        'type' => $faker->numberBetween(RenewalFrequencies::Weeks, RenewalFrequencies::Years),
        'user_id' => factory(App\User::class)->make()
    ];
});

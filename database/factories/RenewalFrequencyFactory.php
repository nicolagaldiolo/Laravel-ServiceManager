<?php

use Faker\Generator as Faker;
use App\Enums\RenewalFrequencies;

$factory->define(App\RenewalFrequency::class, function (Faker $faker) {
    return [
        'value' => 1,
        'type' => RenewalFrequencies::Years,
        'user_id' => factory(App\User::class)->make()
    ];
});

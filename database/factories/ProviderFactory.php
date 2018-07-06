<?php

use Faker\Generator as Faker;

$factory->define(App\Providers::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'label' => $faker->hexColor,
        'website' => $faker->domainName,
        'user_id' => factory(App\User::class)->make()
    ];
});

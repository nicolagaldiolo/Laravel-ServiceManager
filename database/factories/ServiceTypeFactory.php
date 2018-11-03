<?php

use Faker\Generator as Faker;

$factory->define(App\ServiceType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'user_id' => factory(App\User::class)->make(),
    ];
});

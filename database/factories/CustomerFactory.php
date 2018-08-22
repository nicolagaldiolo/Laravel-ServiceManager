<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->tollFreePhoneNumber(),
        'address' => $faker->address(),
        'user_id' => factory(App\User::class)->make()
    ];
});

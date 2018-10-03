<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'label' => $faker->unique()->hexColor,
        'website' => 'http://' . $faker->unique()->domainName,
        'user_id' => factory(App\User::class)->make()
    ];
});

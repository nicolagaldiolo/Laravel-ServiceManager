<?php

use Faker\Generator as Faker;

$factory->define(App\Renewal::class, function (Faker $faker) {
    return [
        'service_id' => factory(App\Service::class)->make(),
        'deadline' => $faker->dateTimeBetween('+0 days', '+2 years'),
        'amount' => $faker->randomFloat(2, 0, 200)
    ];
});

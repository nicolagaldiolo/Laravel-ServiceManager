<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Domains::class, function (Faker $faker) {
    return [
        'url' => 'http://' . $faker->unique()->domainName,
        'domain_id' => factory(App\Providers::class)->make(),
        'hosting_id' => factory(App\Providers::class)->make(),
        'deadline' => $faker->dateTimeBetween('+0 days', '+1 years'),
        'amount' => $faker->randomFloat(2, 0, 200),
        'payed' => $faker->boolean,
        'note' => $faker->text(255),
        'user_id' => factory(App\User::class)->make(),
    ];
});

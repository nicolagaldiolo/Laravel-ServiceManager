<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Domains::class, function (Faker $faker) {
    return [
        'url' => 'http://' . $faker->unique()->domainName,
        'customer_id' => factory(App\Customer::class)->make(),
        'domain_id' => factory(App\Providers::class)->make(),
        'hosting_id' => factory(App\Providers::class)->make(),
        'deadline' => $faker->dateTimeBetween('+0 days', '+1 years')->format('d-m-Y'),
        'amount' => $faker->randomFloat(2, 0, 200),
        'payed' => $faker->boolean,
        'status' => $faker->boolean,
        'note' => $faker->text(255),
        'user_id' => factory(App\User::class)->make(),
    ];
});

<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Enums\FrequencyRenewals;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->domainName,
        'url' => 'http://' . $faker->domainName,
        'customer_id' => factory(App\Customer::class)->make(),
        'provider_id' => factory(App\Provider::class)->make(),
        'service_type_id' => factory(App\ServiceType::class)->make(),
        'renewal_frequency_id' => factory(App\RenewalFrequency::class)->make(),
        'note' => $faker->text(255)
    ];
});

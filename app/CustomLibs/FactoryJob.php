<?php

namespace App\CustomLibs;

use App\RenewalFrequency;
use App\Customer;
use App\Provider;
use App\ServiceType;
use App\Service;
use App\Renewal;
use App\User;

class FactoryJob {

    protected $renewalFrequenciesCtn = 1;
    protected $customersCtn = 10;
    protected $providersCtn = 5;
    protected $seviceTypesCtn = 5;
    protected $servicesCtn = 10;
    protected $renewalsCtn = 1;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        if(config('app.env') === 'production') {
            $this->renewalFrequenciesCtn = 1;
            $this->customersCtn = 1;
            $this->providersCtn = 1;
            $this->seviceTypesCtn = 1;
            $this->servicesCtn = 1;
            $this->renewalsCtn = 1;
        }
    }

    public function run()
    {

        $renewalFrequencies = factory(RenewalFrequency::class, $this->renewalFrequenciesCtn)->create([
            'user_id' => $this->user->id
        ]);
        $customers = factory(Customer::class, $this->customersCtn)->create([
            'user_id' => $this->user->id
        ]);
        $providers = factory(Provider::class, $this->providersCtn)->create([
            'user_id' => $this->user->id
        ]);
        $seviceTypes = factory(ServiceType::class, $this->seviceTypesCtn)->create([
            'user_id' => $this->user->id
        ]);

        factory(Service::class, $this->servicesCtn)->create([
            'customer_id' => collect($customers)->random()->id,
            'provider_id' => collect($providers)->random()->id,
            'service_type_id' => collect($seviceTypes)->random()->id,
            'renewal_frequency_id' => collect($renewalFrequencies)->random()->id
        ])->each(function ($service){
            factory(Renewal::class, $this->renewalsCtn)->create([
                'service_id' => $service->id,
            ]);
        });

    }
}

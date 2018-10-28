<?php

namespace App\Listeners;

use App\Customer;
use App\Events\CustomerRenewalReminder;
use App\Jobs\CustomerReminder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRenewalReminderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CustomerRenewalReminder  $event
     * @return void
     */
    public function handle(CustomerRenewalReminder $event)
    {
        if(!is_null($event->customer)){
            CustomerReminder::dispatch($event->customer);
        }else{
            Customer::servicesExpiring()->get()->each(function($customer){
                CustomerReminder::dispatch($customer);
            });
        }
    }
}

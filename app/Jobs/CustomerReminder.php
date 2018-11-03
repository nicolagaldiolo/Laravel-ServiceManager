<?php

namespace App\Jobs;

use App\Customer;
use App\Mail\CustomerRenewalsReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class CustomerReminder implements ShouldQueue
{
    //use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->customer->update(['token' => str_random(60)]);
        Mail::to($this->customer->email)->locale($this->customer->user->lang)->send(new CustomerRenewalsReminder($this->customer));
    }
}

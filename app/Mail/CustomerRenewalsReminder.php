<?php

namespace App\Mail;

use App\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

class CustomerRenewalsReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name') . ' - ' . __('messages.services_expiring') . ' ' . Str::lower(Date::now()->addMonth()->format('F Y')))
            ->markdown('emails.customers.renewals-reminder');
    }
}

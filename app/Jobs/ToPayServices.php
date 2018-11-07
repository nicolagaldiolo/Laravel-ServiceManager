<?php

namespace App\Jobs;

use App\User;
use App\Mail\ToPayServicesEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;

class ToPayServices implements ShouldQueue
{
    //use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if(!is_null($this->user->email)){
            Date::setLocale($this->user->lang ?? App::getLocale()); // forzo la lingua di default in caso qualche utente abbia la lingua settata a NULL perchè altrimenti Date mi torna l'inglese
            Mail::to($this->user->email)->locale($this->user->lang)->send(new ToPayServicesEmail($this->user));
        }
    }
}

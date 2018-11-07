<?php

namespace App\Jobs;

use App\Mail\UserRegisterEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;

class UserRegisterAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $admin;
    public $userRegistered;
    public function __construct(User $admin, User $userRegistered)
    {
        $this->admin = $admin;
        $this->userRegistered = $userRegistered;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Date::setLocale($this->admin->lang ?? App::getLocale()); // forzo la lingua di default in caso qualche utente abbia la lingua settata a NULL perchè altrimenti Date mi torna l'inglese
        Mail::to($this->admin->email)->locale($this->admin->lang)->send(new UserRegisterEmail($this->admin, $this->userRegistered));
    }
}

<?php

namespace App\Listeners;

use App\Events\UserRegister;
use App\Mail\UserRegisterEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class UserRegisterListener
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
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $user = $event->user;

        $verification_code = str_random(30); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);

        Mail::to($user->email)->send(new UserRegisterEmail($user, $verification_code));
        //logger('Log scatenato da Listener: ' . $event->user->name);
    }
}

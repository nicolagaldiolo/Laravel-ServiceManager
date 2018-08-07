<?php

namespace App\Observers;

use Laravolt\Avatar\Facade as Avatar;
use App\Events\UserRegister;
use App\User;

class UserObserver
{
    /**
     * Handle to the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */

    public function creating(User $user)
    {
        $user->avatar = Avatar::create($user->name)->getImageObject()->encode('png');
    }

    public function created(User $user)
    {

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }
}

<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;
use App\Events\UserRegister;
use App\User;
use File;

class UserObserver
{

    /**
     * Handle to the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->avatar = Avatar::create($user->name)->getImageObject()->encode('png');
    }

    /**
     * Handle to the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle to the user "updating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        //
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
     * Handle to the user "deleting" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
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
        if(File::exists(public_path($user->avatar))) File::delete(public_path($user->avatar));
    }
}

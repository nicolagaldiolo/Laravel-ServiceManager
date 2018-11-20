<?php

namespace App\Observers;

use App\CustomLibs\FactoryJob;
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

    }

    /**
     * Handle to the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->update(['avatar'=> Avatar::create($user->name)->getImageObject()->encode('png')]);

        event(new UserRegister($user));

        $factoryJob = new FactoryJob($user, true);
        $factoryJob->run();

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
        $userDirectory = config('custompath.users') . '/' . $user->id;
        if(Storage::exists($userDirectory)) Storage::deleteDirectory($userDirectory);
    }
}

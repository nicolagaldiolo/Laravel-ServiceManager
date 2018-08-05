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
        //event(new UserRegister($user));

    }

    public function created(User $user)
    {
        // la dimensione la specifico comunque anche nel file di configurazione
        Avatar::create($user->name)->setDimension(200)->save(public_path() . '/storage/avatar/' . $user->id . '.png', 100); // quality = 100
    }

    //public function created(Eloquent $model)
    //{

    //    if(Input::hasFile('logo')) Image::make(Input::file('logo')->getRealPath())->save(public_path() ."/gfx/product/logo_{$model->id}.png");
    //}

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

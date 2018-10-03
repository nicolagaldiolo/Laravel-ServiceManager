<?php

namespace App\Policies;

use App\User;
use App\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the services.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
        return $user->id === $service->user()->id;
    }

    /**
     * Determine whether the user can create services.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the services.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        return $user->id === $service->user()->id;
    }

    /**
     * Determine whether the user can delete the services.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
        return $user->id === $service->user()->id;
    }
}

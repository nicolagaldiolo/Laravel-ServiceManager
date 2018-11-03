<?php

namespace App\Policies;

use App\User;
use App\ServiceType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceTypesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function view(User $user, ServiceType $serviceType)
    {
        return $user->id === $serviceType->user_id;
    }

    /**
     * Determine whether the user can create domains.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function update(User $user, ServiceType $serviceType)
    {
        return $user->id === $serviceType->user_id;
    }

    /**
     * Determine whether the user can delete the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function delete(User $user, ServiceType $serviceType)
    {
        return $user->id === $serviceType->user_id;
    }
}

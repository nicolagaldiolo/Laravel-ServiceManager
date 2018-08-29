<?php

namespace App\Policies;

use App\User;
use App\Domain;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Domain  $domains
     * @return mixed
     */
    public function view(User $user, Domain $domains)
    {
        return $user->id === $domains->user_id;
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
     * @param  \App\Domain  $domains
     * @return mixed
     */
    public function update(User $user, Domain $domains)
    {
        return $user->id === $domains->user_id;
    }

    /**
     * Determine whether the user can delete the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Domain  $domains
     * @return mixed
     */
    public function delete(User $user, Domain $domains)
    {
        return $user->id === $domains->user_id;
    }
}

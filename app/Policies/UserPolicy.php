<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Domains  $domains
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
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
     * @param  \App\Domains  $domains
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Domains  $domains
     * @return mixed
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}

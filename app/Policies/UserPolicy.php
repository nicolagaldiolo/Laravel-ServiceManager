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
     * @param  \App\Service  $domains
     * @return mixed
     */

    public function index(User $currentUser)
    {
        return $currentUser->isAdmin();
    }

    public function view(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->isAdmin();
    }

    /**
     * Determine whether the user can create domains.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $currentUser)
    {
        return $currentUser->isAdmin();
    }

    /**
     * Determine whether the user can update the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->isAdmin();
    }

    /**
     * Determine whether the user can delete the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->isAdmin();
    }

    public function massiveDelete(User $currentUser)
    {
        return $currentUser->isAdmin();
    }
}

<?php

namespace App\Policies;

use App\User;
use App\Renewal;
use Illuminate\Auth\Access\HandlesAuthorization;

class RenewalsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the renewal.
     *
     * @param  \App\User  $user
     * @param  \App\Renewal  $renewal
     * @return mixed
     */
    public function view(User $user, Renewal $renewal)
    {
        //
    }

    /**
     * Determine whether the user can create renewals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the renewal.
     *
     * @param  \App\User  $user
     * @param  \App\Renewal  $renewal
     * @return mixed
     */
    public function update(User $user, Renewal $renewal)
    {
        return $user->id === $renewal->user()->id;
    }

    /**
     * Determine whether the user can delete the renewal.
     *
     * @param  \App\User  $user
     * @param  \App\Renewal  $renewal
     * @return mixed
     */
    public function delete(User $user, Renewal $renewal)
    {
        return $user->id === $renewal->user()->id;
    }
}

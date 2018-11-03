<?php

namespace App\Policies;

use App\RenewalFrequency;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RenewalFrequencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function view(User $user, RenewalFrequency $renewalFrequency)
    {
        return $user->id === $renewalFrequency->user_id;
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
    public function update(User $user, RenewalFrequency $renewalFrequency)
    {
        return $user->id === $renewalFrequency->user_id;
    }

    /**
     * Determine whether the user can delete the domains.
     *
     * @param  \App\User  $user
     * @param  \App\Service  $domains
     * @return mixed
     */
    public function delete(User $user, RenewalFrequency $renewalFrequency)
    {
        return $user->id === $renewalFrequency->user_id;
    }
}

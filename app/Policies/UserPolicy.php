<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $profile
     * @return mixed
     */
    public function view(User $user, $profile)
    {
        return $user->id == $profile->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $profile
     * @return mixed
     */
    public function update(User $user, User $profile)
    {
        return $user->id == $profile->id;
    }

    /**
     * Checks if user is admin before all other checks
     *
     * @param $user
     * @return bool
     */
    public function before($user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}

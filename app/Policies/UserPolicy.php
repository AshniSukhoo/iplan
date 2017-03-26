<?php

namespace Iplan\Policies;

use Iplan\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Check if Logged in user can edit this user.
     *
     * @param User $loggedInUser
     * @param User $profileUser
     *
     * @return bool
     */
    public function edit(User $loggedInUser, User $profileUser)
    {
        return $loggedInUser->id == $profileUser->id;
    }
}

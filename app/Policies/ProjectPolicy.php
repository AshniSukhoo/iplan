<?php

namespace Iplan\Policies;

use Iplan\Entity\User;
use Iplan\Entity\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Check if User can access the Project.
     *
     * @param User $user
     * @param Project $project
     *
     * @return bool
     */
    public function access(User $user, Project $project)
    {
        // User is Owner.
        if ($project->user_id == $user->id) {
            return true;
        }

        // User is a member.
        if ($project->members()->where('users.id', '=', $user->id)->count() == 1) {
            return true;
        }

        return false;
    }

    /**
     * Check if user can modify project.
     *
     * @param User $user
     * @param Project $project
     *
     * @return bool
     */
    public function modify(User $user, Project $project)
    {
        // Check if User is project owner.
        if ($project->user_id == $user->id) {
            return true;
        }

        return false;
    }
}

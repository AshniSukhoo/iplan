<?php

namespace Iplan\Policies;

use Iplan\Entity\User;
use Iplan\Entity\Project;
use Iplan\Entity\WorkItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkItemPolicy
{
    use HandlesAuthorization;


    /**
     * Check if user can access a Work item.
     *
     * @param User $user
     * @param WorkItem $workItem
     * @param Project $project
     *
     * @return bool
     */
    public function access(User $user, WorkItem $workItem, Project $project)
    {
        // User is owner of the work item.
        if ($workItem->user_id == $user->id) {
            return true;
        }

        // User is owner of project.
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
     * Check if user can modify work item.
     *
     * @param User $user
     * @param WorkItem $workItem
     * @param Project $project
     *
     * @return bool
     */
    public function modify(User $user, WorkItem $workItem, Project $project)
    {
        // User is owner of the work item.
        if ($workItem->user_id == $user->id) {
            return true;
        }

        // User is owner of project.
        if ($project->user_id == $user->id) {
            return true;
        }

        return false;
    }
}

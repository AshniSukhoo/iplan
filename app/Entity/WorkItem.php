<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;

class WorkItem extends Model
{
    /**
     * Projects' work items
     *
     * one work item belong only to one project
     */
    public function projectsWorkItems()
    {
        return $this->belongsTo(Project::class);
    }
}

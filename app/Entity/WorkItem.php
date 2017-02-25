<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;

class WorkItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'assigned_user_id',
        'title',
        'type',
        'priority',
        'estimated_time',
        'parent_id',
        'description'
    ];

    /**
     * One WorkItem belong only to one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectOfWorkItem()
    {
        return $this->belongsTo(Project::class);
    }
}

<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    /**
     * User's projects
     */
    public function userProjects()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return Members of this Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * One project may have many work items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workItemsOfProject()
    {
        return $this->hasMany(WorkItem::class);
    }
}

<?php

namespace Iplan\Entity;

use Laravolt\Avatar\Facade as Avatar;
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
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * The assigned User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    /**
     * The Parent Work Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentWorkItem()
    {
        return $this->belongsTo(WorkItem::class, 'parent_id');
    }

    /**
     * Priority Accessor.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function getPriorityAttribute($value)
    {
        if ($value == 1) {
            return 'High';
        } else if ($value == 2) {
            return 'Medium';
        } else {
            return 'Low';
        }
    }

    public function assignedProject()
    {
        return $this->hasMany(ProjectUser::class);
    }

    /**
     * Get project avatar.
     *
     * @return $this
     */
    public function getAvatarAttribute()
    {
        return Avatar::create($this->title)->setDimension(150, 150)->setShape('square')->toBase64();
    }

}

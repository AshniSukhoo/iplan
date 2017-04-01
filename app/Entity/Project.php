<?php

namespace Iplan\Entity;

use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    /**
     * User's projects
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Return Members of this Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
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

    /**
     * Get the Percentage the Project is completed.
     *
     * @return string
     */
    public function getPercentageCompletedAttribute()
    {
        // Get Total count of work items.
        $totalWorkItems = $this->workItemsOfProject()->count();

        // No work items.
        if ($totalWorkItems == 0) {
            return '0%';
        }

        // Get number of work items which are completed.
        $totalCompletedWorkItems = $this->workItemsOfProject()->where('status', '=', 'closed')->count();

        return floor(($totalCompletedWorkItems / $totalWorkItems) * 100).'%';
    }

    /**
     * Get project avatar.
     *
     * @return $this
     */
    public function getAvatarAttribute()
    {
        return Avatar::create($this->name)->setDimension(150, 150)->setShape('square')->toBase64();
    }
}

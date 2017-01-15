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
}

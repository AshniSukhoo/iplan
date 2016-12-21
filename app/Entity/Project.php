<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * User's projects
     */
    public function userProjects()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace Iplan\Presenters\Accessors;

use Laravolt\Avatar\Facade as Avatar;

trait UserAccessors
{
    /**
     * Return User avatar.
     *
     * @return mixed
     */
    public function getAvatarAttribute()
    {
        return Avatar::create($this->full_name);
    }
}

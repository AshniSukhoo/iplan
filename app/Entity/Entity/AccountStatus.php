<?php

namespace Iplan\Entity\Entity;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AccountStatus extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}

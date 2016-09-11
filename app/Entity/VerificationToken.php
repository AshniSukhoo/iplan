<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VerificationToken extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}

<?php

namespace Iplan\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Iplan\Entity\AccountStatus
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Iplan\Entity\User[] $users
 * @mixin \Eloquent
 */
class AccountStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    /**
     * All users with this account status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

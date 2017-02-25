<?php

namespace Iplan\Entity;

use Illuminate\Notifications\Notifiable;
use Iplan\Presenters\Accessors\UserAccessors;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UserAccessors;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'account_status_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Get the Full name of the User.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Account status of the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountStatus()
    {
        return $this->belongsTo(AccountStatus::class);
    }

    /**
     * User's verification token.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verificationToken()
    {
        return $this->hasOne(VerificationToken::class);
    }

    /**
     * Projects of a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * All Projects which User is a member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projectsUserIsMemberOf()
    {
        return $this->belongsToMany(Project::class);
    }
}

<?php

namespace Iplan\Entity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Iplan\Entity\User
 *
 * @property-read \Iplan\Entity\AccountStatus                                                                               $accountStatus
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    
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
     * Projects of user
     */
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}

<?php

namespace Iplan\Repositories;

use Illuminate\Container\Container as Application;
use Iplan\Entity\User;
use Iplan\Repositories\Contracts\UserRepository;
use Iplan\Repositories\Contracts\VerificationTokenRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Creates a User with a verification token.
     *
     * @param array $data
     *
     * @return \Iplan\Entity\User
     */
    public function createWithToken(array $data = [])
    {
        // Creates the User.
        $user = $this->create($data);
        
        // Create the VerificationToken
        $verificationToken = $this->app->make(VerificationTokenRepository::class)->create([
            'token' => str_random(50)
        ]);
        
        // Associate token with User.
        $verificationToken->user()->associate($user);
        
        // Save Token.
        $verificationToken->save();
        
        // Return User.
        return $user;
    }

    /**
     * Verify user.
     *
     * @param User $user
     *
     * @return User
     */
    public function verifyUser(User $user)
    {
        $user->update(['account_status_id' => 1]);

        return $user;
    }

}

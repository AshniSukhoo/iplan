<?php

namespace Iplan\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;
use Iplan\Entity\User;

interface UserRepository extends RepositoryInterface
{
    /**
     * Creates a User with a verification token.
     *
     * @param array $data
     *
     * @return User
     */
    public function createWithToken(array $data = []);

    /**
     * Verify user.
     *
     * @param User $user
     *
     * @return User
     */
    public function verifyUser(User $user);
}
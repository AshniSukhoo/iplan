<?php

namespace Iplan\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    /**
     * Creates a User with a verification token.
     *
     * @param array $data
     *
     * @return \Iplan\Entity\User
     */
    public function createWithToken(array $data = []);
}
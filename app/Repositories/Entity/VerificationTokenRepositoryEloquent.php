<?php

namespace Iplan\Repositories\Entity;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Iplan\Repositories\Contracts\Entity\VerificationTokenRepository;
use Iplan\Entity\VerificationToken;

class VerificationTokenRepositoryEloquent extends BaseRepository implements VerificationTokenRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VerificationToken::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

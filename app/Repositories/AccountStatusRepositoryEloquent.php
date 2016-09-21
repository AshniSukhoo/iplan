<?php

namespace Iplan\Repositories;

use Iplan\Entity\AccountStatus;
use Iplan\Repositories\Contracts\AccountStatusRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class AccountStatusRepositoryEloquent extends BaseRepository implements AccountStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AccountStatus::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

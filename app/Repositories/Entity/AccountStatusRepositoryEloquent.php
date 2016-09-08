<?php

namespace Iplan\Repositories\Entity;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Iplan\Repositories\Contracts\Entity\AccountStatusRepository;
use Iplan\Entity\Entity\AccountStatus;
use Iplan\Validators\Entity\AccountStatusValidator;

/**
 * Class AccountStatusRepositoryEloquent
 * @package namespace Iplan\Repositories\Entity;
 */
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

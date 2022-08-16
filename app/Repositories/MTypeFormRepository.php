<?php

namespace App\Repositories;

use App\Models\MTypeForm;
use App\Contracts\MTypeFormRepositoryInterface;

class MTypeFormRepository extends EloquentRepository implements MTypeFormRepositoryInterface
{
    /**
     * MTypeFormRepository construct
     * 
     * MTypeForm $model
     * @return void
     */
    public function __construct(MTypeForm $model)
    {
        $this->model = $model;
    }
}

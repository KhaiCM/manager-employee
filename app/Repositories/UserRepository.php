<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * UserRepository construct
     * 
     * User $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}

<?php

namespace App\Repositories;

use App\Models\Form;
use App\Contracts\FormRepositoryInterface;

class FormRepository extends EloquentRepository implements FormRepositoryInterface
{
    /**
     * FormRepository construct
     * 
     * @param Form $model
     * @return void
     */
    public function __construct(Form $model)
    {
        $this->model = $model;
    }

    /**
     * Get a list of forms belong to user
     *
     * @param int $userId
     * @return mixed
     */
    public function getFormsByUser($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->get();
    }
}

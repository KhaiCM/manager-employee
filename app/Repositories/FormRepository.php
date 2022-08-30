<?php

namespace App\Repositories;

use App\Models\Form;
use App\Contracts\FormRepositoryInterface;

class FormRepository extends EloquentRepository implements FormRepositoryInterface
{
    /**
     * FormRepository construct
     *
     * Form $model
     * @return void
     */
    public function __construct(Form $model)
    {
        $this->model = $model;
    }

    /**
     * Get all data
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }
}

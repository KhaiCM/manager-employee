<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    /**
     * EloquentRepository construct
     * 
     * Model $model
     * @return void
     */
    public function __construct(Model $model)
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
        return $this->model->all();
    }

    /**
     * Get one data
     * 
     * int|array $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create data
     * 
     * array $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Update data
     * 
     * int $id
     * array $attributes
     * @return mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Insert data
     * 
     * array $attributes
     * @return bool
     */
    public function insert($attributes = []): bool
    {
        return $this->model->insert($attributes);
    }

    /**
     * Get first data
     * 
     * array $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * Get data
     * 
     * array $columns
     * @return mixed
     */
    public function get($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Add a simple where clause to the query.
     *
     * string $column
     * string $operator
     * string $value
     * @return mixed
     */
    public function where($column, $value, $operator = '=')
    {
        return $this->model->where($column, $value, $operator);
    }

    /**
     * Add a simple where in clause to the query
     *
     * string $column
     * mixed $values
     *
     * @return mixed
     */
    public function whereIn($column, $values)
    {
        return $this->model->whereIn($column, $values);
    }

    /**
     * Delete by id
     *
     * integer $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->find($id);

        return $result ? $result->delete() : $result;
    }

            /**
     * Get one data by id
     *
     * integer $id
     * @return mixed
     */
    public function getDataById($id)
    {
        $result = $this->find($id);

        return $result ? $result->first() : $result;
    }
}

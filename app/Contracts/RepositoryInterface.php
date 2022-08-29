<?php

namespace App\Contracts;

interface RepositoryInterface
{
    /**
     * Get all data
     * 
     * @return mixed 
     */
    public function all();

    /**
     * Get data by id
     * 
     * @param string|int|array $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create data
     * 
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update data
     * 
     * @param string|int $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Insert data
     * 
     * @param array $attributes
     * @return bool
     */
    public function insert($attributes = []): bool;

    /**
     * Get first data
     * 
     * @param array $columns
     * @return mixed
     */
    public function first($columns = ['*']);

    /**
     * Get data
     * 
     * @param array $columns
     * @return mixed
     */
    public function get($columns = ['*']);

    /**
     * Add a simple where clause to the query.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @return mixed
     */
    public function where($column, $value, $operator = '=');

    /**
     * Add a simple where in clause to the query
     *
     * @param string $column
     * @param mixed $values
     *
     * @return mixed
     */
    public function whereIn($column, $values);

    /**
     * Delete data by id
     *
     * @param string|integer $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Get one data by id
     *
     * @param string|integer $id
     * @return mixed
     */
    public function getDataById($id);
}

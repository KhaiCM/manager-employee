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
     * Get one data
     * 
     * int|array $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create data
     * 
     * array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update data
     * 
     * int $id
     * array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Insert data
     * 
     * array $attributes
     * @return bool
     */
    public function insert($attributes = []): bool;

    /**
     * Get first data
     * 
     * array $columns
     * @return mixed
     */
    public function first($columns = ['*']);

    /**
     * Get data
     * 
     * array $columns
     * @return mixed
     */
    public function get($columns = ['*']);

    /**
     * Add a simple where clause to the query.
     *
     * string $column
     * string $operator
     * string $value
     * @return mixed
     */
    public function where($column, $value, $operator = '=');

    /**
     * Add a simple where in clause to the query
     *
     * string $column
     * mixed $values
     *
     * @return mixed
     */
    public function whereIn($column, $values);
}

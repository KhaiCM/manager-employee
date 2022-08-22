<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use App\Contracts\PasswordResetRepositoryInterface;

class PasswordResetRepository extends EloquentRepository implements PasswordResetRepositoryInterface
{
    /**
     * PasswordResetRepository construct
     * 
     * PasswordReset $model
     * @return void
     */
    public function __construct(PasswordReset $model)
    {
        $this->model = $model;
    }

    /**
     * Get one record with email
     * 
     * string $email
     * @return mixed
     */
    public function getDataByEmail($email)
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    /**
     * Delete record with email
     * 
     * string $email
     * @return mixed
     */
    public function deleteDataWithEmail($email)
    {
        return $this->model
            ->where('email', $email)
            ->delete();
    }
}

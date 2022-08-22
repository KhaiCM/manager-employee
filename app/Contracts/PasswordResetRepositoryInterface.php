<?php

namespace App\Contracts;

use App\Contracts\RepositoryInterface;

interface PasswordResetRepositoryInterface extends RepositoryInterface
{
    /**
     * Get one record with email
     * 
     * string $email
     * @return mixed
     */
    public function getDataByEmail($email);

    /**
     * Delete record with email
     * 
     * string $email
     * @return mixed
     */
    public function deleteDataWithEmail($email);
}

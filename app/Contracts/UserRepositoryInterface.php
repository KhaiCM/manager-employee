<?php

namespace App\Contracts;

use App\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Get one user with email
     * 
     * string $email
     * @return mixed
     */
    public function getUserByEmail($email);
}

<?php

namespace App\Contracts;

use App\Contracts\RepositoryInterface;

interface FormRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a list of forms belong to user
     *
     * @param int $userId
     * @return mixed
     */
    public function getFormsByUser($userId);
}

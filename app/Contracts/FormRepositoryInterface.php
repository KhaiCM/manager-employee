<?php

namespace App\Contracts;

use App\Contracts\RepositoryInterface;

interface FormRepositoryInterface extends RepositoryInterface
{
    public function getFormsByUser($user_id);
}

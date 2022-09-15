<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    /**
     * Create a new UserService instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Get list of users.
     *
     * @return mixed
     */
    public function getListOfUsers()
    {
        return $this->userRepository->all();
    }

    /**
     * Get data of a user.
     * 
     * @param int $id
     * @return mixed
     */
    public function getUserById($id)
    {
        return $this->userRepository->getDataById($id);
    }

    /**
     * Update data of a user.
     * 
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function updateUser($request, $id)
    {
        $array = [];

        if ($request->new_password) {
            $array = [
                'password' => Hash::make($request->new_password),
            ];
        }

        return $this->userRepository->update($id, array_merge([
            'name' => $request->name,
            'staff_code' => $request->staff_code,
        ], $array));
    }

    /**
     * Soft delete data of a user.
     * 
     * @param int $id
     * @return mixed
     */
    public function deleteUserById($id)
    {
        return $this->userRepository->delete($id);
    }
}

<?php

namespace App\Services;

use App\Contracts\PasswordResetRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthService
{
    protected $userRepository;
    protected $passwordResetRepository;

    /**
     * Create a new AuthService instance.
     *
     * UserRepositoryInterface $userRepository
     * PasswordResetRepositoryInterface $passwordResetRepository
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordResetRepositoryInterface $passwordResetRepository
    ) {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * Create a new user.
     *
     * Request $request
     * @return mixed
     */
    public function createUser($request)
    {
        return $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'staff_code' => $request->staff_code,
        ]);
    }

    /**
     * Update password and delete record from password_resets table
     *
     * String $email
     * String $password
     * @return void
     */
    public function updatePassword($email, $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        $this->userRepository->update($user->id, [
            'password' => Hash::make($password),
        ]);

        $this->passwordResetRepository->deleteDataWithEmail($email);
    }

    /**
     * Get record with email
     *
     * String $email
     * @return mixed
     */
    public function getDataWithEmail($email)
    {
        return $this->passwordResetRepository->getDataByEmail($email);
    }

    /**
     * Save token into password_resets table
     *
     * String $email
     * String $token
     * @return bool
     */
    public function saveToken($email, $token)
    {
        return $this->passwordResetRepository->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * Get record with email and token
     *
     * String $email
     * String $token
     * @return bool
     */
    public function getDataWithEmailAndToken($email, $token)
    {
        return $this->passwordResetRepository
            ->where('email', $email)
            ->where('token', $token)
            ->first();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = $this->userService->getListOfUsers();

        return defineResponse(
            __('messages.success'),
            Response::HTTP_OK,
            $users
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if ($user) {
            return defineResponse(
                __('messages.success'),
                Response::HTTP_OK,
                $user
            );
        }

        return defineResponse(
            __('messages.wrong'),
            Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        if ($user) {
            return defineResponse(
                __('messages.success'),
                Response::HTTP_OK,
                $user
            );
        }

        return defineResponse(
            __('messages.wrong'),
            Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $result = auth()->attempt([
            'email' => auth()->user()->email,
            'password' => $request->password,
        ]);

        if ($result) {
            $user = $this->userService->updateUser($request, $id);

            if ($user) {
                return defineResponse(
                    __('messages.update_success'),
                    Response::HTTP_OK,
                    $user
                );
            }
        }

        return defineResponse(
            __('messages.update_fail'),
            Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->userService->deleteUserById($id);

        if ($result) {
            return defineResponse(
                __('messages.delete_success'),
                Response::HTTP_OK,
            );
        }

        return defineResponse(
            __('messages.delete_fail'),
            Response::HTTP_BAD_REQUEST,
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\FormService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    protected $formService;
    protected $userService;

    /**
     * Create a new HomeController instance.
     *
     * @param FormService $formRepository
     * @param UserService $userService
     * @return void
     */
    public function __construct(
        FormService $formService,
        UserService $userService
    ) {
        $this->formService = $formService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = [
            'forms' => $this->formService->getListOfForms(),
            'users' => $this->userService->getListOfUsers(),
        ];

        return defineResponse(
            __('messages.success'),
            Response::HTTP_OK,
            $data
        );
    }
}

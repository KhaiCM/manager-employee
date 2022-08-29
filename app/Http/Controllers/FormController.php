<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormRequest;
use App\Services\FormService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FormController extends Controller
{
    protected $formService;

    /**
     * Create a new FormController instance.
     *
     * @param FormService $formRepository
     * @return void
     */
    public function __construct(
        FormService $formService
    ) {
        $this->formService = $formService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $forms = $this->formService->getListOfForms();

        return defineResponse(
            __('messages.success'),
            Response::HTTP_OK,
            $forms
        );
    }

    /**
     * Show your self information .
     *
     * @return JsonResponse
     */
    public function getListFormsBelongUser()
    {
        $id = auth()->user()->id;

        $forms = $this->formService->getListOfFormsByUser($id);

        return defineResponse(
            __('messages.success'),
            Response::HTTP_OK,
            $forms
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFormsTable  $request
     * @return JsonResponse
     */
    public function store(CreateFormRequest $request)
    {
        $form = $this->formService->createNewForm($request);

        if ($form) {
            return defineResponse(
                __('messages.create_success'),
                Response::HTTP_OK,
                $form
            );
        }

        return defineResponse(
            __('messages.create_fail'),
            Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  uuid  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->formService->deleteFormByID($id);

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

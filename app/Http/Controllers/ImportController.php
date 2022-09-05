<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Services\FormService;
use App\Services\ImportService;
use Illuminate\Http\Response;

class ImportController extends Controller
{
    protected $userService;
    protected $importService;

    /**
     * Create a new ImportController instance.
     *
     * @param ImportService $importService
     * @return void
     */
    public function __construct(
        FormService $formService,
        ImportService $importService
    ) {
        $this->formService = $formService;
        $this->importService = $importService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        $forms = $this->formService->getListOfForms();

        return view('import', [
            'data' => $forms,
        ]);
    }

    /**
     * Import data into forms table
     *
     * @param ImportRequest $request
     * @return JsonResponse
     */
    public function import(ImportRequest $request)
    {
        $file = $request->file('uploaded_file');
        $result = $this->importService->importFileToFormsTable($file);
        if ($result) {
            return defineResponse(
                __('messages.success'),
                Response::HTTP_OK,
            );
        }

        return defineResponse(
            __('messages.error'),
            Response::HTTP_BAD_REQUEST,
        );
    }
}

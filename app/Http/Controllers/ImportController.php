<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Services\FormService;
use App\Services\ImportService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    protected $userService;
    protected $importService;

    public function __construct(
        FormService $formService,
        ImportService $importService
    ) {
        $this->formService = $formService;
        $this->importService = $importService;
    }

    public function index()
    {
        $forms = $this->formService->getListOfForms();

        return view('import', [
            'data' => $forms,
        ]);
    }

    public function import(ImportRequest $request)
    {
        $file = $request->file('uploaded_file');

        $result = $this->importService->importFileToFormsTable($file);
        dd($result);
        return $result;
    }
}

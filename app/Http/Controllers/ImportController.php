<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
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
        UserService $userService,
        ImportService $importService
    ) {
        $this->userService = $userService;
        $this->importService = $importService;
    }

    public function index()
    {
        $users = $this->userService->getListOfUsers();

        return view('import', [
            'data' => $users,
        ]);
    }

    public function import(ImportRequest $request)
    {
        $file = $request->file('uploaded_file');

        $result = $this->importService->importFileToUsersTable($file);
        dd($result);
        return $result;
    }
}

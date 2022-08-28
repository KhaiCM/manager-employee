<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
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

    public function __construct(UserService $userService) {
        $this->userService = $userService;
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
        return;
    }
}

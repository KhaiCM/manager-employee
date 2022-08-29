<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ImportService
{
    protected $userRepository;

    /**
     * Create a new ImportService instance.
     *
     * UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function importFileToUsersTable($file)
    {
        $extension = $file->getClientOriginalExtension();

        if ($extension == 'csv') {

        }

        switch ($extension) {
            case 'csv':
                $data = get_csv_data($file);

                $reader = new Csv();
                $data = $reader->setDelimiter(',')
                        ->setInputEncoding('Shift-JIS')
                        ->load($file)
                        ->getActiveSheet()
                        ->toArray(null, true, true, true);
                break;
            case 'tsv':
                $data = get_tsv_data($file);
                break;
            default:
                $data = get_excel_data($file);
                break;
        }

        if (! empty($data)) {
            $headers = $data[0];
            if ($this->checkHeader($headers)) {
                array_shift($data);
                array_shift($sheetData);

                $this->handleImportFile($sheetData, $data);
            }
        }

        return true;
    }

    public function handleImportFile($sheetData, $data)
    {
        $this->checkSheetData($sheetData);
    }

    public function checkHeader($headers)
    {
        if (count($headers) != count(config('constants.import.user'))) {
            return false;
        }

        foreach ($headers as $item) {
            if (! in_array(strToSlug($item), array_values(config('constants.import.user')))) {
                return false;
            }
        }

        return true;
    }

    public function checkSheetData($sheetData)
    {
        if (count($sheetData) === 0) {
            return false;
        }

        return true;
    }


}

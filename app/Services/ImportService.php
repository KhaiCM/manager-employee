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

    public function importFileToFormsTable($file)
    {
        $messages = [];
        $extension = $file->getClientOriginalExtension();
        switch ($extension) {
            case 'csv':
                $data = get_csv_data($file);

                $reader = new Csv();
                $sheetData = $reader->setDelimiter(',')
                        ->setInputEncoding('Shift-JIS')
                        ->load($file)
                        ->getActiveSheet()
                        ->toArray(null, true, true, true);
                break;
            case 'tsv':
                $sheetData = get_tsv_data($file);
                break;
            default:
                $sheetData = get_excel_data($file);
                break;
        }

        if (! empty($data)) {
            $headers = $data[0];
            if ($this->checkHeader($headers)) {
                array_shift($data);
                array_shift($sheetData);

                $this->handleImportFile($sheetData, $data, $messages);
            } else {
                $messages[] = __('messages.import.dont_have_header');
            }
        }

        return true;
    }

    public function handleImportFile($sheetData, $data, $messages)
    {
        if ($this->checkSheetData($sheetData)) {
            foreach ($sheetData as $key => $row) {
                if ($this->checkNoColumnBetweenFileAndFormsTable($row)) {
                    $this->validateBeforeImport($row);
                } else {
                    $messages[] = __('messages.import.no_column_invalid', ['line' => $key]);
                }
            }
        } else {
            $messages[] = __('messages.import.none_data');
        }
    }

    public function checkHeader($headers)
    {
        if (count($headers) != count(config('constants.import.form'))) {
            return false;
        }

        foreach ($headers as $item) {
            if (! in_array(strToSlug($item), array_values(config('constants.import.form')))) {
                return false;
            }
        }

        return true;
    }

    public function checkSheetData($sheetData)
    {
        return count($sheetData) != 0 ?: false;
    }

    public function checkNoColumnBetweenFileAndFormsTable($row)
    {
        return count($row) == count(config('constants.import.form')) ?: false;
    }

    public function validateBeforeImport($row)
    {
        # code...
    }


}

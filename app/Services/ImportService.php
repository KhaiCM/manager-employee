<?php

namespace App\Services;

use App\Contracts\FormRepositoryInterface;
use Illuminate\Support\Str;

class ImportService
{
    protected $formRepository;

    /**
     * Create a new ImportService instance.
     *
     * FormRepositoryInterface $formRepository
     * @return void
     */
    public function __construct(
        FormRepositoryInterface $formRepository
    ) {
        $this->formRepository = $formRepository;
    }

    /**
     * Import data into forms table.
     *
     * @param $file
     * @return bool
     */
    public function importFileToFormsTable($file): bool
    {
        $data = getDataImport($file);

        $data_insert = [];

        foreach ($data as $key => $row) {
            array_push($data_insert, [
                'id' => Str::uuid(),
                'status' => getValueOfCell($row[config('constants.import.form.status')]), // B
                'start_time' => getValueOfCell($row[config('constants.import.form.start_time')]), // C
                'end_time' => getValueOfCell($row[config('constants.import.form.end_time')]), // D
                'reason' => getValueOfCell($row[config('constants.import.form.reason')]), // E
                'user_id' => getValueOfCell($row[config('constants.import.form.user')]), //F
                'm_type_form_id' => getValueOfCell($row[config('constants.import.form.type')]), // G
            ]);
        }

        $result = $this->formRepository->insert($data_insert);

        return $result;
    }
}

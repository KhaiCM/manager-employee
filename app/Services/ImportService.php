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
        $data = get_data_import($file);

        foreach ($data as $key => $row) {
            $form = $this->formRepository->create([
                'id' => Str::uuid(),
                'status' => valOfCell($row[config('constants.import.form.status')]),
                'start_time' => valOfCell($row[config('constants.import.form.start_time')]),
                'end_time' => valOfCell($row[config('constants.import.form.end_time')]),
                'reason' => valOfCell($row[config('constants.import.form.reason')]),
                'user_id' => valOfCell($row[config('constants.import.form.user')]),
                'm_type_form_id' => valOfCell($row[config('constants.import.form.type')]),
            ]);

            if (!$form) {
                return false;
            }
        }

        return true;
    }
}

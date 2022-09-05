<?php

namespace App\Rules;

use App\Enums\StatusForm;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidateDataOfFileRule implements Rule
{
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->checkHeaderOfFile($value)) return false;

        $data = getDataImport($value);

        $rules = [
            config('constants.import.form.status') => [ // B
                'required',
                new EnumValue(StatusForm::class, false),
            ],
            config('constants.import.form.start_time') => [ // C
                'required',
                'date_format:Y-m-d H:i',
            ],
            config('constants.import.form.end_time') => [ // D
                'required',
                'date_format:Y-m-d H:i',
                'after:start_time',
            ],
            config('constants.import.form.reason') => [ // E
                'nullable',
                'string',
            ],
            config('constants.import.form.user') => [ // F
                'required',
                'numeric',
                'exists:users,id',
            ],
            config('constants.import.form.type') => [ // G
                'required',
                'numeric',
                'exists:m_type_forms,id',
            ],
        ];

        if ($this->checkEmptyData($data)) {
            foreach ($data as $key => $row) {
                if (count($row) != count(config('constants.import.form'))) { // 6
                    $this->message = __('messages.import.no_column_invalid', ['line' => $key]);

                    return false;
                } else {
                    $validated = Validator::make($row, $rules, [
                        'required' => __('messages.import.validate_cell.required', ['cell' => $key]),
                        'enum_value' => __('messages.import.validate_cell.enum_value', ['cell' => $key]),
                        'date_format' => __('messages.import.validate_cell.date_format', ['cell' => $key]),
                        'after' => __('messages.import.validate_cell.after', ['cell' => $key]),
                        'string' => __('messages.import.validate_cell.string', ['cell' => $key]),
                        'numeric' => __('messages.import.validate_cell.numeric', ['cell' => $key]),
                        'exists' => __('messages.import.validate_cell.exists', ['cell' => $key]),
                    ]);

                    if ($validated->fails()) {
                        $this->message = $validated->errors()->first();

                        return false;
                    }
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * Check header of file import.
     *
     * @return bool
     */
    public function checkHeaderOfFile($value): bool
    {
        $sheetData = getDataImport($value, true);
        $headers = $sheetData[1];

        if (count($headers) != count(config('constants.import.form'))) { // 6
            $this->message = __('messages.import.dont_have_header');

            return false;
        }

        foreach ($headers as $item) {
            if (!in_array(slug($item), array_keys(config('constants.import.form')))) {
                $this->message = __('messages.import.dont_have_header');

                return false;
            }
        }

        return true;
    }

    /**
     * Check empty of data.
     *
     * @return bool
     */
    public function checkEmptyData($data): bool
    {
        if (!count($data)) {
            $this->message = __('messages.import.none_data');

            return false;
        }

        return true;
    }
}

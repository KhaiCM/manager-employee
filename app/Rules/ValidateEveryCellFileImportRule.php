<?php

namespace App\Rules;

use App\Enums\StatusForm;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidateEveryCellFileImportRule implements Rule
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
        $data = get_data_import($value);

        $rules = [
            config('constants.import.form.status') => [
                'required',
                new EnumValue(StatusForm::class, false),
            ],
            config('constants.import.form.start_time') => [
                'required',
                'date_format:Y-m-d H:i',
            ],
            config('constants.import.form.end_time') => [
                'required',
                'date_format:Y-m-d H:i',
                'after:start_time',
            ],
            config('constants.import.form.reason') => [
                'nullable',
                'string',
            ],
            config('constants.import.form.user') => [
                'required',
                'numeric',
                'exists:users,id',
            ],
            config('constants.import.form.type') => [
                'required',
                'numeric',
                'exists:m_type_forms,id',
            ],
        ];

        foreach ($data as $key => $row) {
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
}

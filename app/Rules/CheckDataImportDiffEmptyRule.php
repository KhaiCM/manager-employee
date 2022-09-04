<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDataImportDiffEmptyRule implements Rule
{
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

        return count($data) != 0 ?: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.import.none_data');
    }
}

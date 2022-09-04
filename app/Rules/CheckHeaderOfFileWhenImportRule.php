<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckHeaderOfFileWhenImportRule implements Rule
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
        $sheetData = get_data_import($value, true);
        $headers = $sheetData[1];
        
        if (count($headers) != count(config('constants.import.form'))) {
            return false;
        }

        foreach ($headers as $item) {
            if (! in_array(strToSlug($item), array_keys(config('constants.import.form')))) {
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
        return __('messages.import.dont_have_header');
    }
}

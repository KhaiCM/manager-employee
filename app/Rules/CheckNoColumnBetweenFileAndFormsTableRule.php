<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNoColumnBetweenFileAndFormsTableRule implements Rule
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

        foreach ($data as $key => $row) {
            if (count($row) != count(config('constants.import.form'))) {
                $this->message = __('messages.import.no_column_invalid', ['line' => $key]);

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

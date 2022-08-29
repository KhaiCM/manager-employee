<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MimeTypes implements Rule
{
    protected $mimes;

    /**
     * Create a new rule instance.
     *
     * @param array $mimes
     * @return void
     */
    public function __construct($mimes = [])
    {
        $this->mimes = $mimes;
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
        $extension = $value->getClientOriginalExtension();

        return in_array($extension, $this->mimes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The uploaded file must be a file of type:' . implode(', ', $this->mimes);
    }
}

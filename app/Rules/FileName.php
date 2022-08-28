<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileName implements Rule
{
    protected $max_words;

    /**
     * Create a new rule instance.
     *
     * @param int $max_words
     * @return void
     */
    public function __construct($max_words = 100)
    {
        $this->max_words = $max_words;
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
        $file = $value->getClientOriginalName();
        
        return strlen(explode('.', $file)[0]) <= $this->max_words;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file name must not be greater than' . $this->max_words . 'characters.';
    }
}

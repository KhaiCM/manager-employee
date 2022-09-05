<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckFileWhenImportRule implements Rule
{
    protected $mimes;
    protected $max_words;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param array $mimes
     * @param int $max_words
     * @return void
     */
    public function __construct($mimes = [], $max_words)
    {
        $this->mimes = $mimes;
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
        $extension = $value->getClientOriginalExtension();
        $name = $value->getClientOriginalName();

        if (strlen(explode('.', $name)[0]) >= $this->max_words) {
            $this->message = __('messages.import.check_file_name', [
                'max_words' => $this->max_words,
            ]);

            return false;
        }

        if (!in_array($extension, $this->mimes)) {
            $this->message = __('messages.import.check_file_type', [
                'mimes' => implode(', ', $this->mimes),
            ]);

            return false;
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
